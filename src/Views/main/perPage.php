<nav aria-label="Page navigation example">
    <ul class="pagination justify-content-end">
    <h5>Items per page: </h5>
        <?php if(isset($data['search'])) : ?>
            <li class="page-item"><a class="page-link" href="/<?= $data['controller']?>/<?= $data['method']?>/?page=1&perPage=6&search=<?=$data['search']?>">6</a></li>
            <li class="page-item"><a class="page-link" href="/<?= $data['controller']?>/<?= $data['method']?>/?page=1&perPage=9&search=<?=$data['search']?>">9</a></li>
        <?php else : ?>
            <li class="page-item"><a class="page-link" href="/<?= $data['controller']?>/<?= $data['method']?>/?page=1&perPage=6">6</a></li>
            <li class="page-item"><a class="page-link" href="/<?= $data['controller']?>/<?= $data['method']?>/?page=1&perPage=9">9</a></li>
        <?php endif ;?>    
    </ul>
</nav>