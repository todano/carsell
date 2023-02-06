<nav aria-label="Page navigation example">
    <?php if(isset($data['search'])) : ?>
        <ul class="pagination justify-content-end">
            <?php if(isset($page)) : ?>
                <?php if($page>1) :?>
                <li class="page-item">
                    <a class="page-link" href="/<?= $data['controller']?>/<?= $data['method']?>/?page=<?= ($page-1) ?>&perPage=<?= $perPage ?>&search=<?=$data['search']?>">Previous</a>
                </li>
                <?php endif; ?>
                <?php for($i=1; $i<=$pages;$i++) :?>
                    <?php if($i>2 && $pages-$i>1) continue ;?>
                    <li class="page-item"><a class="page-link" href="/<?= $data['controller']?>/<?= $data['method']?>/?page=<?= $i ?>&perPage=<?= $perPage ?>&search=<?=$data['search']?>"><?= $i ?></a></li>
                <?php endfor; ?>
                <?php if($page<$pages) :?>
                <li class="page-item">
                    <a class="page-link" href="/<?= $data['controller']?>/<?= $data['method']?>/?page=<?= ($page+1) ?>&perPage=<?= $perPage ?>&search=<?=$data['search']?>">Next</a>
                </li>
                <?php endif; ?>
            <?php endif ; ?>  
        </ul>
    <?php else : ?>    
        <ul class="pagination justify-content-end">
            <?php if(isset($page)) : ?>
                <?php if($page>1) :?>
                <li class="page-item">
                    <a class="page-link" href="/<?= $data['controller']?>/<?= $data['method']?>/?page=<?= ($page-1) ?>&perPage=<?= $perPage ?>">Previous</a>
                </li>
                <?php endif; ?>
                <?php for($i=1; $i<=$pages;$i++) :?>
                    <?php if($i>2 && $pages-$i>1) continue ;?>
                    <li class="page-item"><a class="page-link" href="/<?= $data['controller']?>/<?= $data['method']?>/?page=<?= $i ?>&perPage=<?= $perPage ?>"><?= $i ?></a></li>
                <?php endfor; ?>
                <?php if($page<$pages) :?>
                <li class="page-item">
                    <a class="page-link" href="/<?= $data['controller']?>/<?= $data['method']?>/?page=<?= ($page+1) ?>&perPage=<?= $perPage ?>">Next</a>
                </li>
                <?php endif; ?>
            <?php endif ; ?>  
        </ul>
    <?php endif ;?>    
</nav>