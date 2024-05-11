<?php include "../Include/header.php"; ?>
<?php include "../Include/sidebar.php"; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Bootstrap 3.3.7 -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                <font color="black">Criar Acesso</font>
                <small></small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="index.php"><i class="fa fa-dashboard"></i>Casa</a></li>
                <li class="active"></li>
            </ol>
        </section>
        <section class="content">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <form action="register_admin.php" method="post" class="row g-3" enctype="multipart/form-data">
                        <div class="col-md-6">
                            <label>Nome</label>
                            <input type="text" class="form-control" name="name" id="name" />
                        </div>
                        <div class="col-md-6">
                            <label>Sobre Nome</label>
                            <input type="text" class="form-control" name="sobrenome" id="sobrenome" />
                        </div>
                        <div class="col-md-6">
                            <label>Email</label>
                            <input type="email" class="form-control" name="email" id="email" />
                        </div>
                        <div class="col-md-6">
                            <label>Senha</label>
                            <input type="password" class="form-control" name="senha" id="senha" />
                        </div>
                        <div class="col-md-6">
                            <label>Telefone</label>
                            <input type="text" class="form-control" name="telefone" id="telefone" />
                        </div>
                        <div class="col-md-6">
                            <label>Anexar Ficheiro</label>
                            <input class="form-control" type="file" name="file" id="fileToUpload">
                        </div>
                        <div class="col-md-12">
                            </br></br>
                            <input type="submit" name="submit" id="submit" class="form-control" value="Salvar" STYLE="color: #FFFFFF; font-family: Verdana; font-weight: bold; font-size: 12px; background-color: #16035a;" size="10" maxlength="30" class="form-control" class="btn btn-primary" />
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
</body>
</html>

<?php include '../Include/footer.php'; ?>
