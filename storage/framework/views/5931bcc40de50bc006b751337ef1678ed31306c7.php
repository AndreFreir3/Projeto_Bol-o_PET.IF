<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bolao IF</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
        <link rel="stylesheet" href="<?php echo e(url('assets/css/apostas.css')); ?>">

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">

   

</head>

<body>
    <nav class="navbar navbar-expand-lg bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Bolão do IF</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="<?php echo e(route('welcome')); ?>">Home</a>
                    </li>
                    <?php if(auth()->guard()->check()): ?>
                        <li class="nav-item">
                            <a class="nav-link active" href="<?php echo e(route('apostas.index')); ?>">Minhas Apostas</a>
                        </li>
                    <?php endif; ?>
                    <?php if(auth()->guard()->check()): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo e(route('usuarios')); ?>">Usuarios</a>
                        </li>
                    <?php endif; ?>
                </ul>
                <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
                <?php if(auth()->guard()->check()): ?>
                    <form class="d-flex ms-3" action="<?php echo e(route('logout')); ?>" method="GET">
                        <?php echo csrf_field(); ?>
                        <button class="btn btn-outline-success" type="submit">Sair</button>
                    </form>
                <?php endif; ?>
            </div>
        </div>
    </nav>


  <main>  

  <div id="modal-aposta" class="modal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="<?php echo e(route('apostas.update')); ?>" method="post">
                    <div class="modal-header">
                        <h5 class="modal-title">Editar Aposta</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <?php echo csrf_field(); ?>
                        <div id="modal-aposta-content">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn btn-primary">Salvar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

<section id="jogos">
            <div class="container">
               <div class="row">
                <div class="col md-4">
                    <div class="row">
                        <div class="col-12">
                        <div class="card my-3 flex-column align-items-center d-flex p-3">
                                <img src="<?php echo e(url('assets/img/perfil.png')); ?>" alt="Perfil" class="perfil">
                                <p class="text-center fs-3 mb-2"><?php echo e(Auth::user()->nome); ?></p>
                                <p class="text-center fs-6">Número de apostas: <?php echo e(Auth::user()->apostas()->count()); ?></p>
                            </div>
                        </div>
                    </div>
                    <p class="titulo fs-4 mb-1 text-center fw-bold light-text">Minhas Apostas</p>
                    <div id="minhas-apostas" class="row p-3">
                        <?php $__currentLoopData = $apostas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $aposta): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-12">
                                <div class="card p-3 mb-3">
                                    <div class=" d-flex justify-content-evenly align-items-center h-100">
                                        <div class="time d-flex flex-column align-items-center">
                                            <img src='<?php echo e(url('assets/img/bandeiras/') . '/' . $aposta->jogo->bandeira_1); ?>'
                                                alt="<?php echo e($aposta->jogo->time_1); ?>">
                                            <span class="text-center fw-semibold"><?php echo e($aposta->jogo->time_1); ?></span>
                                        </div>

                                        <span class="fs-3 text-secondary text-center fw-bold"><span
                                                class="palpite"><?php echo e($aposta->palpite_1); ?></span>x<span
                                                class="palpite"><?php echo e($aposta->palpite_2); ?></span></span>

                                        <div class="time d-flex flex-column align-items-center">
                                            <img src='<?php echo e(url('assets/img/bandeiras/') . '/' . $aposta->jogo->bandeira_2); ?>'
                                                alt="<?php echo e($aposta->jogo->time_1); ?>">
                                            <span class="text-center fw-semibold"><?php echo e($aposta->jogo->time_2); ?></span>
                                        </div>

                                        <div>
                                        <a href="#"onclick="editar_aposta(<?php echo e($aposta); ?>)"
                                                title="editar"><i class="bi bi-pencil-square"></i></a>
                                            <form id="form-deletar" action="<?php echo e(route('apostas.destroy', [$aposta->id])); ?>" method="post">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('delete'); ?>
                                                <a href="javascript:{}" onclick="document.getElementById('form-deletar').submit();" title="deletar"><i class="bi bi-trash"></i></a>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
                <div class="col-md-8">
                  <div class="row p-3">
                  <?php if($errors->all()): ?>
                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="col-12">
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <?php echo e($message); ?>

                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                        <?php $__currentLoopData = $jogos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $jogo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="col-12">
                                <div class="card p-3 mb-3">
                                    <form action="<?php echo e(route('apostas.store')); ?>" method="POST">
                                        <div class="card-body d-flex flex-column justify-content-center">
                                            <?php echo csrf_field(); ?>
                                            <div class="d-flex justify-content-evenly align-items-center h-100">
                                                <div class="time d-flex flex-column align-items-center">
                                                    <img src='<?php echo e(url("assets/img/bandeiras/$jogo->bandeira_1")); ?>'
                                                        alt="Tunísia">
                                                    <span class="text-center fw-semibold"><?php echo e($jogo->time_1); ?></span>
                                                </div>
                                                <input type="hidden" name="id" value="<?php echo e($jogo->id); ?>">
                                                <input type="number" name="palpite_1" min="0"
                                                    value="<?php echo e($jogo->palpite_1 ?? ''); ?>">
                                                <span class="fs-3 text-secondary text-center fw-bold">7:00</span>
                                                <input type="number" name="palpite_2" min="0"
                                                    value="<?php echo e($jogo->palpite_2 ?? ''); ?>">
                                                <div class="time d-flex flex-column align-items-center">
                                                    <img src='<?php echo e(url("assets/img/bandeiras/$jogo->bandeira_2")); ?>'
                                                        alt="Austrália">
                                                    <span class="text-center fw-semibold"><?php echo e($jogo->time_2); ?></span>
                                                </div>
                                            </div>
                                            <button type="submit"
                                                class="btn-apostar btn btn-light w-30 mx-auto">Apostar</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <div class="row px-3">
                            <div class="col-12 d-flex flex-column align-items-center">
                                <?php echo e($jogos->links()); ?>

                            </div>
                        </div>
                  </div> 
                </div>
               </div> 
            </div>
        </section> 
</main>
    <section id="rodape">
        <div class="row h-100">
            <div class="col-12 d-flex flex-column justify-content-center">
                <p class="text-center">Desenvolvido por - <?php echo e(date('Y')); ?></p>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
    <script>
         const editar_aposta = (aposta) => {
            console.log("aposta", aposta);
            let content = `<div class="col-12">
                                <div class="card p-3 mb-3">
                                    <div class=" d-flex justify-content-evenly align-items-center h-100">
                                        <input type="hidden" name="id" value="${aposta.id}"/>
                                        <div class="time d-flex flex-column align-items-center">
                                            <img src='assets/img/bandeiras/${aposta.jogo.bandeira_1}'
                                                alt="${aposta.jogo.time_1 }">
                                            <span class="text-center fw-semibold">${aposta.jogo.time_1}</span>
                                        </div>
                                        <span class="fs-3 text-secondary text-center fw-bold">
                                            <input type="number" name="palpite_1" min="0"
                                                    value="${aposta.palpite_1}" style="width:50px">
                                                <span class="fs-3 text-secondary text-center fw-bold"> x </span>
                                                <input type="number" name="palpite_2" min="0"
                                                    value="${aposta.palpite_2}"   style="width:50px">
                                            </span>
                                        <div class="time d-flex flex-column align-items-center">
                                            <img src='assets/img/bandeiras/${aposta.jogo.bandeira_2 }'
                                                alt="${aposta.jogo.time_1}">
                                            <span class="text-center fw-semibold">${aposta.jogo.time_2}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            `;
            $("#modal-aposta-content").html(content);
            $("#modal-aposta").modal("show");
        }
    </script>
</body>

</html>
<?php /**PATH C:\Users\andre\Downloads\aula-05\laravel-aula-05\resources\views/apostas.blade.php ENDPATH**/ ?>