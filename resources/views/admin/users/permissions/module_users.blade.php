<div class="col-md-4 d-flex">
    <div class="container-fluid">
        <div class="panel shadow">

            <div class="header">
                <h2 class="title">
                    <i class="fas fa-user"></i>
                    Modulo Usuarios
                </h2>
            </div>

            <div class="inside">
                <div class="form-check">
                    <input type="checkbox" value="true" name="user_list" @if (kvfj($user->permissions, 'user_list')) checked @endif>
                    <label for="user_list">
                        Puede ver el listado de usuarios.
                    </label>
                </div>
                <div class="form-check">
                    <input type="checkbox" value="true" name="user_edit" @if (kvfj($user->permissions, 'user_edit')) checked @endif>
                    <label for="user_edit">
                        Puede editar usuarios.
                    </label>
                </div>
                <div class="form-check">
                    <input type="checkbox" value="true" name="user_banned" @if (kvfj($user->permissions, 'user_banned')) checked @endif>
                    <label for="user_banned">
                        Puede banear/bloquear usuarios.
                    </label>
                </div>
                <div class="form-check">
                    <input type="checkbox" value="true" name="user_permissions" @if (kvfj($user->permissions, 'user_permissions')) checked @endif>
                    <label for="user_permissions">
                        Puede otorgar permisos a usuarios.
                    </label>
                </div>
            </div>

        </div>
    </div>
</div>
