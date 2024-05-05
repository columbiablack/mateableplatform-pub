<?php


/**
 * Copyright (c) 2024. Mateable LLC
 */

/**
 * @var Wallet $historyModel
 */

use mateable\core\models\Wallet;
echo "<pre>";
var_dump($historyList);
var_dump($historyModel);
echo "</pre>";
exit;

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

                echo '
                    </div>
                        <div class="table-responsive table mt-2" role="grid" aria-describedby="dataTable_info">
                            <table id="dataTable" class="table my-0">
                                <thead>
                                    <tr>
                                        <th>Wallet Address</th>
                                        <th>Amount</th>
                                        <th>Date</th>
                                        <th>Type</th>
                                    </tr>
                                </thead>
                                <tbody>
    ';

                $i = -1;
                while($i < count($historyList)-1){
                    $i++;
                    $historyModel = $historyList[$i];
                    $button = mateable\core\form\Form::begin('/walletmgr/dispose','post');
                    echo '                              <tr>
                                       <td>'. $historyModel->id .' '. $button->field($historyModel, 'id')->hiddenField() .'</td>
                                       <td><i class="rounded-circle me-2 icon-wallet" width="30" height="30"></i> '. $historyModel->address .'</td>
                                       <td>'. $historyModel->creation_date .'</td>
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
