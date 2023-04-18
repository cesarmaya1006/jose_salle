<div class="row d-flex justify-content-evenly">
    <div class="col-lg-3 col-6">
        <div class="small-box bg-info bg-gradient">
            <div class="inner">
                <h3>{{$propuestas->count()}}</h3>
                <p>Cant Propuestas</p>
            </div>
            <div class="icon">
                <i class="ion ion-bag"></i>
            </div>
            @if ($jurados->count()&&$emprendedores->count())
            <a href="{{route('propuestas-index')}}" class="small-box-footer">Ver <i class="fas fa-arrow-circle-right"></i></a>
            @endif
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box bg-success bg-gradient">
            <div class="inner">
                <h3>{{$jurados->count()}}</h3>
                <p>Jurados</p>
            </div>
            <div class="icon">
                <i class="fas fa-chalkboard-teacher"></i>
            </div>
            <a href="#" class="small-box-footer">Administrar <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box bg-warning bg-gradient">
            <div class="inner">
                <h3>{{$emprendedores->count()}}</h3>
                <p>Emprendedores</p>
            </div>
            <div class="icon">
                <i class="fas fa-graduation-cap"></i>
            </div>
            <a href="#" class="small-box-footer">Administrar <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
</div>
<hr>
<ion-icon name="school-outline"></ion-icon>
