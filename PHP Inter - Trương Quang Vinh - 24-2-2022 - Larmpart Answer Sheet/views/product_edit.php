</pre>
<div>
    <h3>Edit product</h3>
    <form method="POST" action="/products/<?php echo $params[0]->id ?>" enctype="multipart/form-data">
        <div class="form-group">
            <label for="product_name">Product name</label>
            <input <?php echo !$params[2] ? "disabled" : "" ?> type="text" class="form-control" name="product_name" value="<?php echo $params[0]->product_name ?>">
        </div>
        <input type="hidden" name="id" value="<?php echo $params[0]->id ?>">
        <div class="form-group">
            <label for="category_id">Category</label>

            <select name="category_id" id="category_id" <?php echo !$params[2] ? "disabled" : "" ?>>
                <?php foreach ($params[1] as $param) { ?>
                    <option value="<?php echo $param["id"] ?>" <?php echo $params[0]->category_id == $param['id'] ? "selected" : "";  ?>> <?php echo $param['category_name'] ?> </option>
                <?php } ?>
            </select>

        </div>
        <div class="form-group">
            <label for="category_id">Product image</label>
            <?php if ($params[2]) { ?>
                <input type="file" name="image_url">
            <?php } ?>



        </div>
        <?php if (!$params[2]) { ?>
        <div class="form-group">
            <img src="/images/<?php echo $params[0]->image_url ?>" alt="<?php echo $params[0]->image_url ?>" height="100px" width="100px">
        </div>
        <?php } ?>

        <?php if ($params[2]) { ?>
            <button type="submit" class="btn btn-primary">Submit</button>
        <?php } ?>


    </form>
</div>

</div>