<?php

    class Employe{
        static public function getAll(){
            $stmt = DB::connect()->prepare('SELECT * FROM employee');
            $stmt->execute();
            return $stmt->fetchAll();
            $stmt->close();
            $stmt = null;
        }

        static public function add($data){
            $stmt = DB::connect()->prepare('INSERT INTO employee (nom, prenom, matricule, departement, poste, date_emb, statut)
            VALUES (:nom, :prenom, :matricule, :departement, :poste, :date_emb, :statut)');
            $stmt->bindParam(':nom', $data['nom']);
            $stmt->bindParam(':prenom', $data['prenom']);
            $stmt->bindParam(':matricule', $data['matricule']);
            $stmt->bindParam(':departement', $data['depart']);
            $stmt->bindParam(':poste', $data['nom']);
            $stmt->bindParam(':date_emb', $data['date_emb']);
            $stmt->bindParam(':statut', $data['statut']);

            if($stmt->execute()){
                return 'ok';
            }else{
                return 'error';
            }
            $stmt->close();
            $stmt = null;
        }

        static public function getEmploye($data){
            $id = $data['id'];
            try{
                $query = 'SELECT * FROM employee WHERE id = :id';
                $stmt = DB::connect()->prepare($query);
                $stmt->execute(array(":id" => $id));
                $employe = $stmt->fetch(PDO::FETCH_OBJ);
                return $employe;
            }catch(PDOException $ex){
                echo 'erreur' . $ex->getMessage();
            }
        }

        static public function update($data){
            $stmt = DB::connect()->prepare('UPDATE employee SET nom = :nom, prenom = :prenom, matricule = :matricule, 
            departement = :departement, poste = :poste, date_emb = :date_emb, statut = :statut WHERE id = :id');
             $stmt->bindParam(':id', $data['id']);
            $stmt->bindParam(':nom', $data['nom']);
            $stmt->bindParam(':prenom', $data['prenom']);
            $stmt->bindParam(':matricule', $data['matricule']);
            $stmt->bindParam(':departement', $data['depart']);
            $stmt->bindParam(':poste', $data['nom']);
            $stmt->bindParam(':date_emb', $data['date_emb']);
            $stmt->bindParam(':statut', $data['statut']);
            if($stmt->execute()){
                return 'ok';
            }else{
                return 'error';
            }
            $stmt->close();
            $stmt = null;
        }

        static public function delete($data){
            $id = $data['id'];
            try{
                $query = 'DELETE FROM employee WHERE id = :id';
                $stmt = DB::connect()->prepare($query);
                $stmt->execute(array(":id" => $id));
                if($stmt->execute()){
                    return 'ok';
                }
            }catch(PDOException $ex){
                echo 'erreur' . $ex->getMessage();
            }
        }

        static public function searchEmploye($data){
            $search = $data['search'];
            try{
                $query = 'SELECT * FROM employee WHERE nom LIKE ? OR prenom LIKE ?';
                $stmt = DB::connect()->prepare($query);
                $stmt->execute(array('%' .$search. '%','%' .$search. '%'));
                return $employes = $stmt->fetchAll();
            }catch(PDOException $ex){
                echo 'erreur' . $ex->getMessage();
            }
        }

    }

?>