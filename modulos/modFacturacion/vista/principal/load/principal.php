                    <div class="col-lg-12 col-xlg-12 col-md-12">
                        <div class="card">
                            <ul class="nav nav-tabs profile-tab" role="tablist">
                                <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#home" role="tab">Accesos Rápidos</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="home" role="tabpanel">
                                    <div class="card-body">
                                        <div class="card-deck">
                                            <div class="card">
                                                <img src="../../../../lib/assets/images/img-cotizacion.jpg" class="card-img-top" alt="...">
                                                <div class="card-body">
                                                    <h5 class="card-title">Cotizacion Manual</h5>
                                                    <p class="card-text">Elaborar una cotizacion manualmente</p>
                                                    <a href="#" class="btn btn-primary" id="shortcut-cotizacionmanual">ir a cotizacion</a>
                                                </div>
                                            </div>
                                            <div class="card">
                                                <img src="../../../../lib/assets/images/img-cf.png" class="card-img-top" alt="...">
                                                <div class="card-body">
                                                    <h5 class="card-title">Consumidor Final</h5>
                                                    <p class="card-text">Elaborar una factura consumir final</p>
                                                    <a href="#" class="btn btn-primary">ir a Factura CF</a>
                                                </div>
                                            </div>
                                            <div class="card">
                                                <img src="../../../../lib/assets/images/img-ccf.jpg" class="card-img-top" alt="...">
                                                <div class="card-body">
                                                    <h5 class="card-title">Crédito Fiscal</h5>
                                                    <p class="card-text">Elaborar un crédito fiscal</p>
                                                    <a href="#" class="btn btn-primary">ir a Factura CCF</a>
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
                            $("#shortcut-cotizacionmanual").click(function(e) {
                                e.preventDefault();
                                cargando('Cargando Contenido...')
                                $("#root").load("load/principales/bqCotizacionManual", function() {
                                    swal.close();
                                });
                            });
                        })
                    </script>
