<x-app-layout isFluid=true>
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">

                <div class="col">
                    <h2 class="page-title">Inicio</h2>
                </div>

            </div>
        </div>
    </div>
    <div class="page-body">
        <div class="container-xl">
            <div class="row row-cards">

                <div class="col-12">
                    <div class="card">
                        <div id="pdf-viewer"></div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-xl-4 mb-3">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Catálogo de áreas</h3>
                        </div>
<pre><code><span >CREATE</span> <span >TABLE</span> areas(
    <span >id</span> <span>INTEGER</span> <span >UNSIGNED</span> PRIMARY <span >KEY</span> AUTO_INCREMENT,
    clave <span>VARCHAR</span>(<span class="hljs-number">8</span>) <span >NOT</span> <span>NULL</span>, <span class="text-muted">-- Abreviatura del departamento</span>
    area <span>VARCHAR</span>(<span class="hljs-number">60</span>) <span >NOT</span> <span>NULL</span>,
    descripcion <span>VARCHAR</span>(<span class="hljs-number">255</span>),
    created_at <span >TIMESTAMP</span> <span >DEFAULT</span> <span >CURRENT_TIMESTAMP</span>,
    updated_at <span >TIMESTAMP</span> <span >DEFAULT</span> <span >CURRENT_TIMESTAMP</span> <span >ON</span> <span >UPDATE</span>
    <span >CURRENT_TIMESTAMP</span>
);
</code></pre>

                    </div>
                </div>
                <div class="col-12 col-md-6 col-xl-4 mb-3">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Catálogo de puestos</h3>
                        </div>
<pre><code><span>CREATE</span> <span>TABLE</span> puestos(
    <span>id</span> <span>INTEGER</span> <span>UNSIGNED</span> PRIMARY <span>KEY</span> AUTO_INCREMENT,
    puesto <span>VARCHAR</span>(<span class="hljs-number">60</span>) <span>NOT</span> <span>NULL</span>,
    descripcion <span>VARCHAR</span>(<span class="hljs-number">255</span>),
    created_at <span>TIMESTAMP</span> <span>DEFAULT</span> <span>CURRENT_TIMESTAMP</span>,
    updated_at <span>TIMESTAMP</span> <span>DEFAULT</span> <span>CURRENT_TIMESTAMP</span> <span>ON</span> <span>UPDATE</span>
    <span>CURRENT_TIMESTAMP</span>
);
</code></pre>

                    </div>
                </div>
                <div class="col-12 col-md-6 col-xl-4 mb-3">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Tabla de Empleados</h3>
                        </div>
<pre><code><span>CREATE</span> <span>TABLE</span> empleados(
    <span>id</span> <span>INTEGER</span> <span>UNSIGNED</span> PRIMARY <span>KEY</span> AUTO_INCREMENT,
    nombre <span>VARCHAR</span>(<span class="hljs-number">60</span>) <span>NOT</span> <span>NULL</span>,
    ape_pat <span>VARCHAR</span>(<span class="hljs-number">60</span>),
    ape_mat <span>VARCHAR</span>(<span class="hljs-number">60</span>),
    fecha_nac <span>DATE</span>,
    telefono <span>VARCHAR</span>(<span class="hljs-number">10</span>) <span>NOT</span> <span>NULL</span>,
    email <span>VARCHAR</span>(<span class="hljs-number">100</span>),
    no_empleado <span>SMALLINT</span> <span>UNSIGNED</span>,
    fecha_contratacion <span>DATE</span>,
    estatus <span>BOOLEAN</span> <span>DEFAULT</span> <span class="hljs-number">1</span>, <span class="text-muted">-- Activo o inactivo</span>
    created_at <span>TIMESTAMP</span> <span>DEFAULT</span> <span>CURRENT_TIMESTAMP</span>,
    updated_at <span>TIMESTAMP</span> <span>DEFAULT</span> <span>CURRENT_TIMESTAMP</span> <span>ON</span> <span>UPDATE</span>
    <span>CURRENT_TIMESTAMP</span>,
    deleted_at <span>TIMESTAMP</span> <span>DEFAULT</span> <span>NULL</span> <span class="text-muted">-- Eliminado lógico</span>
);
</code></pre>

                    </div>
                </div>
                <div class="col-12 col-md-6 col-xl-4 mb-3">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Registro histórico de puestos del empleado</h3>
                        </div>
<pre><code><span>CREATE</span> <span>TABLE</span> empleado_puesto(
    <span>id</span> <span>INTEGER</span> <span>UNSIGNED</span> PRIMARY <span>KEY</span> AUTO_INCREMENT,
    puesto_id <span>INTEGER</span> <span>UNSIGNED</span> <span>NOT</span> <span>NULL</span>,
    area_id <span>INTEGER</span> <span>UNSIGNED</span> <span>NOT</span> <span>NULL</span>,
    empleado_id <span>INTEGER</span> <span>UNSIGNED</span> <span>NOT</span> <span>NULL</span>,
    salario_bruto <span>DECIMAL</span>(<span class="hljs-number">10</span>,<span class="hljs-number">2</span>),
    salario_neto <span>DECIMAL</span>(<span class="hljs-number">10</span>,<span class="hljs-number">2</span>),
    created_at <span>TIMESTAMP</span> <span>DEFAULT</span> <span>CURRENT_TIMESTAMP</span>,
    updated_at <span>TIMESTAMP</span> <span>DEFAULT</span> <span>CURRENT_TIMESTAMP</span> <span>ON</span> <span>UPDATE</span>
    <span>CURRENT_TIMESTAMP</span>
);
</code></pre>

                    </div>
                </div>

                <div class="col-12 col-md-6 col-xl-4 mb-3">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Relaciones</h3>
                        </div>
<pre><code><span>ALTER</span> <span>TABLE</span> empleado_puesto
    <span>ADD</span> <span>CONSTRAINT</span> fk_empleado_puesto_areas_area_id
    FOREIGN <span>KEY</span> (area_id) <span>REFERENCES</span> areas(<span>id</span>);
    </code></pre>
    <pre><code><span>ALTER</span> <span>TABLE</span> empleado_puesto
    <span>ADD</span> <span>CONSTRAINT</span> fk_empleado_puesto_puestos_puesto_id
    FOREIGN <span>KEY</span> (puesto_id) <span>REFERENCES</span> puestos(<span>id</span>);
    </code></pre>
    <pre><code><span>ALTER</span> <span>TABLE</span> empleado_puesto
    <span>ADD</span> <span>CONSTRAINT</span> fk_empleado_puesto_empleados_empleado_id
    FOREIGN <span>KEY</span> (empleado_id) <span>REFERENCES</span> empleados(<span>id</span>);
</code></pre>

                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script src="{{asset('js/pdfobject.min.js')}}"></script>
        <script>
            PDFObject.embed( 'erd', "#pdf-viewer", {height: "40rem"});
        </script>
    @endpush
</x-app-layout>
