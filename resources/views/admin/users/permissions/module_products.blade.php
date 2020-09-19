<div class="col-md-4 d-flex">
    <div class="container-fluid">
        <div class="panel shadow">

            <div class="header">
                <h2 class="title">
                    <i class="fas fa-boxes"></i>
                    Modulo Productos
                </h2>
            </div>

            <div class="inside">
                <div class="form-check">
                    <input type="checkbox" value="true" name="products" @if (kvfj($user->permissions, 'products')) checked @endif>
                    <label for="products">
                        Puede ver el listado productos.
                    </label>
                </div>
                <div class="form-check">
                    <input type="checkbox" value="true" name="products_add" @if (kvfj($user->permissions, 'products_add')) checked @endif>
                    <label for="products_add">
                        Puede agregar productos.
                    </label>
                </div>
                <div class="form-check">
                    <input type="checkbox" value="true" name="products_edit" @if (kvfj($user->permissions, 'products_edit')) checked @endif>
                    <label for="products_edit">
                        Puede editar productos.
                    </label>
                </div>
                <div class="form-check">
                    <input type="checkbox" value="true" name="products_delete" @if (kvfj($user->permissions, 'products_delete')) checked @endif>
                    <label for="products_delete">
                        Puede eliminar productos.
                    </label>
                </div>
                <div class="form-check">
                    <input type="checkbox" value="true" name="product_gallery_add" @if (kvfj($user->permissions, 'product_gallery_add')) checked @endif>
                    <label for="product_gallery_add">
                        Puede agregar imagenes en la galeria.
                    </label>
                </div>
                <div class="form-check">
                    <input type="checkbox" value="true" name="product_gallery_delete" @if (kvfj($user->permissions, 'product_gallery_delete')) checked @endif>
                    <label for="product_gallery_delete">
                        Puede eliminar imagenes en la galeria.
                    </label>
                </div>
            </div>

        </div>
    </div>
</div>
