<?php
/**
 * Copyright (c) 2024. Mateable LLC
 */

use mateable\core\models\Wallet;
use mateable\core\form\Form;
use mateable\core\Platform;

/**
 * @var Wallet $walletModel
 */
?>
<section class="content-section clean-block py-3">
    <div class="clean-info container">
        <div class="card shadow">
            <div class="card-header py-3">
                <p class="text-primary m-0 fw-bold"><?php echo(Platform::$app->user->displayFirstName()."'s [".Platform::$app->user->displayEmail()."] Wallet Manager"); ?></p>
            </div>
            <div class="card border-1 shadow">
                <div class="card-header py-3">
                    <p class="text-primary m-0 fw-bold">Options</p>
                </div>
<?php

    if(count($wallet_list) <= 0){
        Platform::$app->session->setFlash('warning', 'Warning!!!<br /> You have not created a wallet to store your addresses.<br /><br /> Note: After you create your first wallet make an address!');
        echo '
                            <div class="row py-3">';
                                $btnCreate =  mateable\core\form\Form::begin('/walletmgr/n/wallet','post');
                                echo $btnCreate->button('New wallet');
                                echo $btnCreate::end();
    }else{
        echo '                        <div class="row py-3">';
                                $btnCreate =  mateable\core\form\Form::begin('/walletmgr/n/address','post');
                                echo $btnCreate->button('New address');
                                echo $btnCreate::end();
        echo '                        </div>
                            <div class="row py-3">';
                                $btnCreate =  mateable\core\form\Form::begin('/walletmgr/n/wallet','post');
                                echo $btnCreate->button('New wallet');
                                echo $btnCreate::end().
                                '</div>';
    }

    echo '                </div>
                        <div class="table-responsive table mt-2" role="grid" aria-describedby="dataTable_info">
                            <table id="dataTable" class="table my-0">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Wallet Address</th>
                                        <th>Created</th>
                                        <th>MTBC</th>
                                        <th>USD</th>
                                        <th>Remove</th>
                                    </tr>
                                </thead>
                                <tbody>
    ';

    $i = -1;
    while($i < count($wallet_list)-1){
        $i++;
        $walletModel = $wallet_list[$i];
        $button = mateable\core\form\Form::begin('/walletmgr/dispose','post');
        echo '                              <tr>
                                       <td>'. $walletModel->id .' '. $button->field($walletModel, 'id')->hiddenField() .'</td>
                                       <td><i class="rounded-circle me-2 icon-wallet" width="30" height="30"></i> '. $walletModel->address .'</td>
                                       <td>'. $walletModel->creation_date .'</td>
                                       <td><i class="icon-btc"></i>'. Platform::$app->mateablecoin->satoshitize(Platform::$app->mateablecoin->getbalance()) .' </td>
                                       <td>$'. Platform::$app->xeggeX->getCoinUSDValue(Platform::$app->mateablecoin->getbalance()) .'</td>
                                       <td>'. $button->button("Delete", "", "btn-sm bg-danger") .'</td>
                                   </tr>
                                   '.
                                    $button::end();
    }
    echo '
                            </tbody>
                            <tfoot>
                                <tr>
                                    
                                </tr>
                            </tfoot>
                        </table>
                    </div>
    ';
    ?>
                </div>
            </div>
        </div>
    </section>

<section class="content-section clean-block py-3">
    <div class="clean-info container">
        <div class="card shadow">
            <div class="card border-1 shadow">
                <div class="card-header py-3">
                    <p class="text-primary m-0 fw-bold">Options</p>
                </div>
