<div>
    <h3>Add a new product</h3>
    <form method="POST" action="/products" enctype="multipart/form-data">
        <div class="form-group">
            <label for="product_name">Product name</label>
            <input type="text" class="form-control" name="product_name">
        </div>
        <div class="form-group">
            <label for="category_id">Category</label>

            <select name="category_id" id="category_id">
                <?php foreach ($params as $param) { ?>
                    <option value="<?php echo $param['id'] ?>"><?php echo $param['category_name'] ?></option>
                <?php } ?>
            </select>

        </div>
        <div class="form-group">
            <label for="category_id">Product image</label>
            <input type="file" name="image_url" id="">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>

    </form>
</div>

</div>