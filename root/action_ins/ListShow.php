<?php
    require("../conn.php");
    $falg = $_POST['falg'];
//  $falg = 'listMesType_detail';
    
    switch($falg){
        //获取表单类型信息
        case 'listMesType':
            $type = $_POST['type'];
            $projectId = $_POST['projectId'];
            $DepIdS = $_POST['RolId'];
//          $type = 'tab';
//          $projectId = '0b5c5b47-0927-48ec-a336-9b925881ec54';
//          $DepIdS = '4';
            
            /*
             * 根据文件类型查询对应的所有类型
             * 根据类型id，项目id，角色id查询表单当前状态视图【sign_check】 ：此项目对应类型对应觉得的应处理信息条数
             */
            //设置文件类型，文档为1，表单为0
            $sign = 1;
            if($type=='tab')
            {
                $sign = 0;
            }
            //获取所有类型
            $sql = "select id,TypNam from type_mes where TypeFT = ".$sign." order by id";
            $result = $conn->query($sql);
            if($result->num_rows>0)
            {
                $i = 0;
                while($row = $result->fetch_assoc())
                {
                    $data['data'][$i]['id'] = $row['id'];
                    $data['data'][$i]['TypNam'] = $row['TypNam'];
                    //计算类型对应的表单数量
//                  $CountForm = "select COUNT(id) as num from table_mes where TabTyp = '".$row['id']."' and TabSta = 1";
                    $CountForm = "select COUNT(signId) as num from sign_check where TabTyp = '".$row['id']."' and TabSta = 1 and ProAId = '".$projectId."' and DepIdS = '".$DepIdS."'";
                    $result_CountForm = $conn->query($CountForm)->fetch_assoc();
                    $data['data'][$i]['Num'] = $result_CountForm['num'];
//                  print_r($data);echo '<br/>';
                    $i++;
                }
                $data['status'] = 'success';
            }
            else{
                $data['status'] = 'fail';
            }
            $json = json_encode($data);
            echo $json;
            break;
            
        //获取表单信息
        case 'listMesType_detail':
            session_start();
            $DepIdS = $_SESSION['RolIdS'];
            $TypeId = $_POST['TypeId'];
            $projectId = $_POST['projectId'];
//          $TypeId = '8';
//          $projectId = '0b5c5b47-0927-48ec-a336-9b925881ec54';
//          $DepIdS = 4;
            
            /*
             * 根据类型id，项目id，文件类型，角色id查询表单当前状态视图【sign_check】 ：此项目对应类型对应觉得的应处理信息条数
             */
            //根据类型id查找表单信息
                //表单查询
            $data['status'] = 'fail';
//          $sql_GetMes = "select id,TabNam,TabCTm,TabDTm,CirSmp from table_mes where TabTyp = ".$TypeId." and ProAId = '".$projectId."' and TabSta = 1 order by TabDTm";
            $sql_GetMes = "select id,CirSmp,TabDTm,TabNam,TabCTm from sign_check where TabTyp = ".$TypeId." and ProAId = '".$projectId."' and TabSta = 1 and DepIdS = '".$DepIdS."' order by TabDTm";
            $result_GetMes = $conn->query($sql_GetMes);
            if($result_GetMes->num_rows>0)
            {
                $i = 0;
                $data['row'] = 0;
                while($row = $result_GetMes->fetch_assoc())
                {
                    $data['CirSmp'][$i] = $row['CirSmp'];
                    $data['data'][$i]['id'] = $row['id'];
                    $data['data'][$i]['TabNam'] = $row['TabNam'];
                    $data['data'][$i]['TabCTm'] = $row['TabCTm'];
                    $data['data'][$i]['TabDTm'] = $row['TabDTm'];
                    $i++;
                }
                $data['row'] = $i;

//              if($result_GetMes->num_rows>0)
//              {
//                  //遍历表单信息
//                  while($row = $result_GetMes->fetch_assoc())
//                  {
//                      $data['CirSmp'][$i] = $row['CirSmp'];
//                      //获取表单当前程序【当前审批状态】
//                      $sql_Cir = "select DepIdS from circle_td where SigSta = 0 and CirSmp = '".$row['CirSmp']."' order by id desc";
//                      $result_Cir = $conn->query($sql_Cir)->fetch_assoc();
//                      $data['RolIdS'][$i] = $result_Cir['DepIdS'];
//                      if($result_Cir['DepIdS'] == $DepIdS)
//                      {
//                          $data['data'][$i]['id'] = $row['id'];
//                          $data['data'][$i]['TabNam'] = $row['TabNam'];
//                          $data['data'][$i]['TabCTm'] = $row['TabCTm'];
//                          $data['data'][$i]['TabDTm'] = $row['TabDTm'];
//                          $i++;
//                      }
//                  }
//                  $data['row'] = $i;
//              }

                if($data['row'] > 0)
                {
                    $data['status'] = 'success';
                }
            }
            else
            {
                $data['status'] = 'fail';
            }
            
            $json = json_encode($data);
            echo $json;
            break;
        
        default:break;
    }
    
    

    
