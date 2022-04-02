<div id="cambio_direccion" class="card d-none">
            <div class="card-header">
                Direccion del Usuario
            </div>
            <div class="card-body">
                <form action="perfil/direccion.php" method="post" enctype="multipart/form-data">
                    <!-- Introducción del nombre para actualizar -->
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Direccion:</label>
                        <input type="text" class="form-control" id="direccion" name="direccion" value="" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Ciudad:</label>
                        <input type="text" class="form-control" id="ciudad" name="ciudad" value="" required>
                    </div>
                    <div class="btn-group" role="group" aria-label="">
                        <button type="submit" name="actualizar" value="actualizar" class="btn btn-success">Actualizar</button>
                    </div>
                </form>
            </div>
        </div>