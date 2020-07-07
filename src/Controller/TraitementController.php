<?php
namespace App\Controller;
use PDO;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
class TraitementController extends AbstractController
{
public function executeSql($bdd,$sql){
    $data=$bdd->query($sql);
    $output='';
    if(($data->rowCount()>0)){
        while($donnees=$data->fetch()){
            $output .= '<tr>
                    <td>'.$donnees["matricule"].'</td>
                    <td>'.$donnees["prenom"].'</td>
                    <td>'.$donnees["nom"].'</td>
                    <td>'.$donnees["email"].'</td>';
                    $data2=$bdd->query('SELECT num_chambre FROM chambre WHERE id LIKE '.$donnees["chambre_id"].'');
                    while($donnees2=$data2->fetch()){
                        $output .= '<td>'.$donnees2["num_chambre"].'</td>';
                    }
                    $output .=' <td><a href="etudiant\update\\'.$donnees["id"].'"><input type="button" class="btn btn-primary" value="Modifier"></a></td>
                    <td><a href="etudiant\delete\\'.$donnees["id"].'" onclick="return confirm(\'Vous vous supprimer\')"><input type="button" class="btn btn-danger" value="Supprimer"></a></td>
                    </tr>'; 
        }
    }else{
        $output.='<tr><td colspan="7">....loading</td></tr>';
    }
        $response = new Response($output);
        return $response;
}
 public function __invoke(){
    $bdd = new PDO("mysql:host=localhost;port=3308;dbname=saalloc","root","");
    if(isset($_POST['limit']) && isset($_POST['offset'])){
        $limit = $_POST['limit'];
        $offset=$_POST['offset'];
        $sql=
        'SELECT *
        FROM etudiant
        ORDER BY id ASC 
        LIMIT ' .$offset.','.$limit
        ;
        return new Response($this->executeSql($bdd,$sql)); 
    }
    if(isset($_POST['selection']) && $_POST['search_value']){
        $search_value=$_POST['search_value'];  
        $selection = $_POST['selection'];
            $sql="SELECT * FROM etudiant WHERE $selection LIKE '%$search_value%'";
            return new Response($this->executeSql($bdd,$sql));
        }
    }
}
