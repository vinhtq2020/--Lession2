<h1>category</h1>


<div class="row">
    <div class="col-md-12">
        <form action="/categories" method="GET">
            <input type="text" class="form-control" name="keyword">  
        </form>
</div>
    <div class="col-md-6">
        <?php if(isset($_GET['keyword'])){ 
        ?>Search found <?php echo $params['total'] ?> results
        <?php } ?></div>

    <div class="col-md-6">
        <div class="text-right"><a href="/categories/create" class="btn"><i class="fa fa-plus-circle" aria-hidden="true"></i></a></div>
    </div>

    <div class="col">
        <table class="table border">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Category</th>
                    <th>Operation</th>
                </tr>
            </thead>
            <tbody>

                <pre><?php foreach ($params['row'] as $param) { ?></pre>
                <tr>
                    <td><?php echo $param['id'] ?></td>
                    <td><?php echo $param['category_name'] ?></td>
                    <td>
                        <form action="/categories/<?php echo $param['id'] ?>/delete" method="POST">
                            <a href="/categories/<?php echo $param['id'] ?>/edit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                            </a>
                            <button class="btn btn-sm" type="submit"><span class="text-primary"><i class="fa fa-minus-circle" aria-hidden="true"></i></span></button>
                            <a href=""><i class="fa fa-clipboard" aria-hidden="true"></i>
                            </a>
                            <a href="/categories/<?php echo $param['id'] ?>"><i class="fa fa-eye" aria-hidden="true"></i>
                            </a>
                        </form>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
    <?php if(!isset($_GET["keyword"])){ ?>
    <div class="col-12">
        <div class="d-flex justify-content-center">
            <nav aria-label="...">
                <ul class="pagination">
                <?php if($params["current_page"] - 1>0){ ?>
                    <li class="page-item ">
                        <a class="page-link" href="/categories?page=<?php echo $params["current_page"]-1 ?>" >Previous</a>
                    </li>
                    <?php } ?>
                    <?php if($params["current_page"] - 1>0){ ?>
                    <li class="page-item"><a class="page-link" href="/categories?page=<?php echo $params["current_page"]-1 ?>"><?php echo $params["current_page"]-1 ?></a></li>
                    <?php } ?>
                    <li class="page-item active">
                        <a class="page-link" href="product?page=<?php echo $params["current_page"] ?>"><?php echo $params["current_page"] ?> <span class="sr-only">current</span></a>
                    </li>
                    <?php if($params["current_page"] + 1<=$params["total_pages"]){ ?>
                    <li class="page-item"><a class="page-link" href="/categories?page=<?php echo $params["current_page"]+1 ?>"><?php echo $params["current_page"]+1 ?></a></li>
                    <?php } ?>
                    <?php if($params["current_page"] + 1<=$params["total_pages"]){ ?>
                    <li class="page-item"><a class="page-link" href="/categories?page=<?php echo $params["current_page"]+1 ?>">Next</a></li>
                    <?php } ?>
                    
                </ul>
            </nav>
        </div>
    </div>
     <?php }?>         

</div>