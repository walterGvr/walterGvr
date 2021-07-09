                    <div class="col-lg-12 col-xlg-12 col-md-12">
                        <div class="card">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs profile-tab" role="tablist">
                                <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#home" role="tab">Notificaciones</a>
                                </li>
                            </ul>
                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div class="tab-pane active" id="home" role="tabpanel">
                                    <div class="card-body">
                                        <div class="card-deck">
                                            <div class="card">
                                                <img src="../../../../lib/assets/images/img-cotizacion.jpg" class="card-img-top" alt="...">
                                                <div class="card-body">
                                                    <h5 class="card-title">Productos</h5>
                                                    <p class="card-text">Administrar los productos.</p>
                                                    <a href="#" class="btn btn-primary" id="shortcut-productos">ir a Productos</a>
                                                </div>
                                            </div>
                                            <div class="card">
                                                <img src="../../../../lib/assets/images/img-cf.png" class="card-img-top" alt="...">
                                                <div class="card-body">
                                                    <h5 class="card-title">Compras Nacionales</h5>
                                                    <p class="card-text">Administrar las compras nacionales.</p>
                                                    <a href="#" class="btn btn-primary">ir a Compras Nacionales</a>
                                                </div>
                                            </div>
                                            <div class="card">
                                                <img src="../../../../lib/assets/images/img-ccf.jpg" class="card-img-top" alt="...">
                                                <div class="card-body">
                                                    <h5 class="card-title">Compras Internacionales</h5>
                                                    <p class="card-text">Administrar las compras internacionales.</p>
                                                    <a href="#" class="btn btn-primary">ir a Compras Internacionales</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <script>
                        $(document).ready(function(){
                            $("#shortcut-productos").click(function(e) {
                                e.preventDefault();
                                cargando('Cargando Contenido...')
                                $("#root").load("load/principales/bqProductos", function() {
                                    swal.close();
                                });
                            });
                        })
                    </script>