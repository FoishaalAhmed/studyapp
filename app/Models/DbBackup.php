<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DbBackup extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    function storeDbBackup()
    {
        $dbFileName = self::backupDbTables(env('DB_HOST'), env('DB_USERNAME'), env('DB_PASSWORD'), env('DB_DATABASE'));

        if ($dbFileName == null) {
            return;
        }

        $this->name = $dbFileName;
        $this->save();
        session()->flash('success', 'New Backup Created Successfully!');
    }

    /**
     * Undocumented function
     *
     * @param  [type] $host
     * @param  [type] $user
     * @param  [type] $pass
     * @param  [type] $name
     * @param  string $tables
     * @return void
     */
    private function backupDbTables($host, $user, $pass, $name, $tables = '*')
    {
        try {
            $con = mysqli_connect($host, $user, $pass, $name);
        } catch (Exception $exception) {
            session()->flash('error', $exception->getMessage());
            return;
        }

        if (mysqli_connect_errno()) {
            session()->flash('error', "Failed to connect to MySQL: " . mysqli_connect_error());
            return;
        }

        $con->set_charset("utf8mb4");

        if ($tables == '*') {
            $tables = array();
            $result = mysqli_query($con, 'SHOW TABLES');
            while ($row = mysqli_fetch_row($result)) {
                $tables[] = $row[0];
            }
        } else {
            $tables = is_array($tables) ? $tables : explode(',', $tables);
        }

        $return = '';
        foreach ($tables as $table) {
            $result     = mysqli_query($con, 'SELECT * FROM ' . $table);
            $num_fields = mysqli_num_fields($result);

            $row2 = mysqli_fetch_row(mysqli_query($con, 'SHOW CREATE TABLE ' . $table));
            $return .= "\n\n" . str_replace("CREATE TABLE", "CREATE TABLE IF NOT EXISTS", $row2[1]) . ";\n\n";

            for ($i = 0; $i < $num_fields; $i++) {
                while ($row = mysqli_fetch_row($result)) {
                    $return .= 'INSERT INTO ' . $table . ' VALUES(';
                    for ($j = 0; $j < $num_fields; $j++) {
                        $row[$j] = addslashes($row[$j]);
                        $row[$j] = preg_replace("/\n/", "\\n", $row[$j]);
                        if (isset($row[$j])) {
                            $return .= '"' . $row[$j] . '"';
                        } else {
                            $return .= '""';
                        }
                        if ($j < ($num_fields - 1)) {
                            $return .= ',';
                        }
                    }
                    $return .= ");\n";
                }
            }

            $return .= "\n\n\n";
        }

        $backupName = date('Y-m-d-His') . '.sql';

        $directoryPath = "public/db-backups";

        if (!file_exists($directoryPath)) {
            mkdir($directoryPath, config('file_permission', 0755), true);
        }

        $handle = fopen($directoryPath . '/' . $backupName, 'w+');
        fwrite($handle, $return);
        fclose($handle);

        return $backupName;
    }
}
