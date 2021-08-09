 <?php
 if (User::userIsAllowedTo("Manage AWPB") && ($user->district_id > 0 || $user->district_id != '')) {


                                        echo '<li class="nav-item has-treeview menu-open">'
                                        . ' <a href="#" class="nav-link active">';
                                    } else {
                                        echo '<li class="nav-item has-treeview">'
                                        . '<a href="#" class="nav-link">';
                                    }
                                    
                                   
                                  
                                        if (User::userIsAllowedTo('Manage programme-wide AWPB') && ( $user->district_id == 0 || $user->district_id == '')) {
                                            echo '   <li class="nav-item">';
                                            if (
                                                    Yii::$app->controller->id == "awpb-budget" &&
                                                    (Yii::$app->controller->action->id == "indexpw" ||
                                                    Yii::$app->controller->action->id == "viewpw" ||
                                                    Yii::$app->controller->action->id == "createpw" ||
                                                    Yii::$app->controller->action->id == "updatepw")
                                            ) {
                                                echo Html::a('<i class="far fa-dot-circle nav-icon"></i> <p>Activity Line</p>', ['awpb-budget/indexpw', 'id' => $session['awpb_template_id']], ["class" => "nav-link active"]);
                                            } else {
                                                echo Html::a('<i class="far fa-dot-circle nav-icon"></i> <p>Activity Line</p>', ['awpb-budget/indexpw', 'id' => $session['awpb_template_id']], ["class" => "nav-link"]);
                                            }
                                            echo '</li>';
                                        }


                                        if (User::userIsAllowedTo('Approve AWPB - PCO') && ( $user->province_id == 0 || $user->province_id == '')) {

                                            echo '   <li class="nav-item">';
                                            if (
                                                    Yii::$app->controller->id == "awpb-budget" &&
                                                    (Yii::$app->controller->action->id == "mpwpco" ||
                                                    Yii::$app->controller->action->id == "mpwpcoa")
                                            ) {
                                                echo Html::a('<i class="far fa-dot-circle nav-icon"></i> <p>PCO Approval</p>', ['awpb-budget/mpwpco', 'id' => $session['awpb_template_id']], ["class" => "nav-link active"]);
                                            } else {
                                                echo Html::a('<i class="far fa-dot-circle nav-icon"></i> <p>PCO Approval</p>', ['awpb-budget/mpwpco', 'id' => $session['awpb_template_id']], ["class" => "nav-link"]);
                                            }
                                            echo '</li>';
                                        }

                                        if (User::userIsAllowedTo('Approve AWPB - Ministry') && ( $user->province_id == 0 || $user->province_id == '')) {
                                            echo '   <li class="nav-item">';
                                            if (
                                                    Yii::$app->controller->id == "awpb-budget" &&
                                                    (Yii::$app->controller->action->id == "mpwm" ||
                                                    Yii::$app->controller->action->id == "mpwma")
                                            ) {
                                                echo Html::a('<i class="far fa-dot-circle nav-icon"></i> <p>Ministry Approval</p>', ['awpb-budget/mpwm', 'id' => $session['awpb_template_id']], ["class" => "nav-link active"]);
                                            } else {
                                                echo Html::a('<i class="far fa-dot-circle nav-icon"></i> <p>Ministry Approval</p>', ['awpb-budget/mpwm', 'id' => $session['awpb_template_id']], ["class" => "nav-link"]);
                                            }
                                            echo '</li>';
                                        }
                                        ?>