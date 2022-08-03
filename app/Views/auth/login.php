<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title></title>
        <meta name="description" content="">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
        
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="">
    </head>
    <body>
       <div class="container">
        <div class="row mt-3">
            <div class="col-md-4 offset-4">
                <h4> SIGN IN</h4><hr>
            </div>
            <form method="POST" action="<?= base_url('Auth/Check')?>" class="form mb-3">
                <?= csrf_field(); ?>
                <?php    if(!empty(session()->getFlashData('success'))){    ?>
                                <div class="alert alert-success">
                                    <?= 
                                        session()->getFlashData('success')
                                    ?>
                                </div>
                            <?php
                        }else  if(!empty(session()->getFlashData('fail'))){
                            ?>
                                <div class="alert alert-danger">
                                    <?= 
                                        session()->getFlashData('fail')
                                    ?>
                                </div>
                            <?php
                        }
                    ?>

                <div class = "form-group mb-3">
                    <label for=" email">  Enter Email</label>
                    <input type="email" class="form-control" name="email" value="<?= set_value('email'); ?>">
                    <span class="text-danger text-sm"><?= isset($validation) ? display_form_errors($validation, 'email') : ''?></s pan>
                </div>
                <div class = "form-group mb-3">
                    <label for=" password">  Enter Password</label>
                    <input type="password" class="form-control" name="password">
                    <span class="text-danger text-sm"><?= isset($validation) ? display_form_errors($validation, 'password') : ''?></span>
                </div>
                <div class = "form-group mb-3">
          
                    <input type="submit" class=" btn btn-success" name="Login" value="Login">
                </div>

            </form>
            <br>
            <a  href="<?= site_url('auth/register') ?>" > Already have an account </a>
        </div>
       </div>
        
        <script src="" async defer></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js" integrity="sha384-ODmDIVzN+pFdexxHEHFBQH3/9/vQ9uori45z4JjnFsRydbmQbmL5t1tQ0culUzyK" crossorigin="anonymous"></script>
    </body>
</html>