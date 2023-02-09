<footer>
    <?php if(!empty($data['msg']) && empty($data['errors'])) :?>
        <script>
            Swal.fire({
            title: "<?= (($data['msg'])? 'Success!' : 'Success') ?>",
            text: "<?= $data['msg'] ?>",
            icon: "<?= (($data['msg'])? 'success' : 'success') ?>",
            confirmButtonText: 'Cool'
            })
        </script>
    <?php endif ;?>    
    <?php if(!empty($data['msg']) && !empty($data['errors'])) : ?>
        <script>
            Swal.fire({
            title: "<?= (($data['msg'])? 'Error!' : 'Error') ?>",
            text: "<?= $data['msg'] ?>",
            icon: "<?= (($data['msg'])? 'error' : 'error') ?>",
            confirmButtonText: 'Cool'
            })
        </script>    
    <?php endif ?>
</footer>