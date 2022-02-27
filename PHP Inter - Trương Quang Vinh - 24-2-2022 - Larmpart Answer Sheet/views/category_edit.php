<div>
    <h3>Edit category</h3>
    <form method="POST" action="/categories/<?php echo $params[0]->id?>">
        <div class="form-group">
            <label for="category_name">Category name</label>
            <input type="hidden" value="<?php echo $params[0]->id?>" name="id"/>
            <input type="text" class="form-control" name="category_name" value="<?php echo $params[0]->category_name?>" <?php echo !$params[1]?'disabled':"" ; ?> >
        </div>
        <?php if($params[1]){?>
        <button type="submit" class="btn btn-primary">Submit</button>
        <?php } ?>
    </form>
</div>