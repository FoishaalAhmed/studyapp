<?php 
	
	if (session()->has('success') || session()->has('error')) {
			
		$alert   = session()->has('success') ? 'success' : 'danger';
		$message = session()->has('success') ? session('success') : session('error');
?>

    <div class="alert alert-<?= $alert ?> alert-dismissible fade show" role="alert">
        <?= $message ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>

<?php } ?>
