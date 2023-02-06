<footer>
    <?php if(!empty($data['msg'])) :?>
        <script>
            Swal.fire({
            title: "<?= (($data['error'])? 'Error!' : 'Success') ?>",
            text: "<?= $data['msg'] ?>",
            icon: "<?= (($data['error'])? 'error' : 'success') ?>",
            confirmButtonText: 'Cool'
            })
        </script>
    <?php endif ?>
</footer>