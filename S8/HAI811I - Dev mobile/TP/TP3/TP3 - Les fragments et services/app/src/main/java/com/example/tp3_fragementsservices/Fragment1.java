package com.example.tp3_fragementsservices;

import android.annotation.SuppressLint;
import android.content.Intent;
import android.os.Bundle;

import androidx.fragment.app.Fragment;
import androidx.fragment.app.FragmentManager;
import androidx.fragment.app.FragmentTransaction;

import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.Button;
import android.widget.CheckBox;
import android.widget.EditText;
import android.widget.Toast;

import org.json.JSONException;
import org.json.JSONObject;

import java.io.BufferedReader;
import java.io.File;
import java.io.FileInputStream;
import java.io.IOException;
import java.io.InputStreamReader;
import java.util.ArrayList;

public class Fragment1 extends Fragment {

    EditText prenomField, nomField, anniversaireField, telephoneField, mailField;

    // Nom du fichier json
    String FILE_NAME = "data.json";

    // Constructeur
    public Fragment1() {}

    // Création de la vue pour le fragment 1
    @Override
    @SuppressLint("MissingInflatedId")
    public View onCreateView(LayoutInflater inflater, ViewGroup container,Bundle savedInstanceState) {

        // Associé la vue au layout du fragment 1
        View view = inflater.inflate(R.layout.fragment_1, container, false);

        // Récuperer les id des champs de saisie
        prenomField = view.findViewById(R.id.prenom_field);
        nomField = view.findViewById(R.id.nom_field);
        anniversaireField = view.findViewById(R.id.anniversaire_field);
        telephoneField = view.findViewById(R.id.telephone_field);
        mailField = view.findViewById(R.id.mail_field);
        CheckBox sportsCheckbox = view.findViewById(R.id.sports_checkbox);
        CheckBox musiqueCheckbox = view.findViewById(R.id.musique_checkbox);
        CheckBox lectureCheckbox = view.findViewById(R.id.lecture_checkbox);
        CheckBox dessinCheckbox = view.findViewById(R.id.dessin_checkbox);
        CheckBox photoCheckbox = view.findViewById(R.id.photo_checkbox);
        CheckBox langueCheckbox = view.findViewById(R.id.langue_checkbox);
        CheckBox syncCheckbox = view.findViewById(R.id.sync_checkbox);

        // Regarder si le fichier existe déjà dans le téléphone
        File file = new File(getActivity().getFilesDir(), FILE_NAME);
        if (file.exists()) {
            try {
                loadData();
            }
            catch (IOException | JSONException e) {
                throw new RuntimeException(e);
            }
        }

        // Récuperer le bouton de soumission et faire quelque chose quand on clique dessus
        Button submitButton = view.findViewById(R.id.submit_button);
        submitButton.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {

                // Recuperer les valeurs
                String prenom = prenomField.getText().toString();
                String nom = nomField.getText().toString();
                String anniversaire = anniversaireField.getText().toString();
                String telephone = telephoneField.getText().toString();
                String mail = mailField.getText().toString();

                // Pour les interets on crée une liste
                ArrayList<String> interests = new ArrayList<>();
                // Si c'est coché on ajoute à la liste
                if (musiqueCheckbox.isChecked()) {
                    interests.add("Musique");
                }
                if (lectureCheckbox.isChecked()) {
                    interests.add("Lecture");
                }
                if (sportsCheckbox.isChecked()) {
                    interests.add("Sport");
                }
                if (photoCheckbox.isChecked()) {
                    interests.add("Photo");
                }
                if (dessinCheckbox.isChecked()) {
                    interests.add("Dessin");
                }
                if (langueCheckbox.isChecked()) {
                    interests.add("Langue");
                }
                // Si le bouton de synchronisation est coché alors on met le boolean sync a true
                boolean sync = false;
                if (syncCheckbox.isChecked()) {
                    sync = true;
                }

                // Verification des champs pour être sur qu'ils soient remplit
                if (prenom.length() < 1 || nom.length() < 1 || anniversaire.length() < 1 || telephone.length() < 10 || mail.length() < 1 || !mail.contains("@")){
                    Toast.makeText(getActivity() ,R.string.avertissement,Toast.LENGTH_SHORT).show();
                }
                else {

                    // On enregistre les informations dans un bundle
                    Bundle bundle = new Bundle();
                    bundle.putString("prenom", prenom);
                    bundle.putString("nom", nom);
                    bundle.putString("anniversaire", anniversaire);
                    bundle.putString("telephone", telephone);
                    bundle.putString("mail", mail);
                    bundle.putStringArrayList("interests", interests);
                    bundle.putBoolean("sync", sync);

                    // Création du deuxième fragment
                    Fragment2 fragment2 = new Fragment2();
                    fragment2.setArguments(bundle);

                    // Changement de fragment dans le main
                    FragmentManager fragmentManager = requireActivity().getSupportFragmentManager();
                    FragmentTransaction fragmentTransaction = fragmentManager.beginTransaction();
                    fragmentTransaction
                            .replace(R.id.fragment_container_form, fragment2)
                            .addToBackStack(null)
                            .commit();
                }
            }
        });

        //Gestion du bouton de telechargement
        Button accueilButton = view.findViewById(R.id.accueil_button);
        accueilButton.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Intent intent = new Intent(getActivity(), MainActivity.class);
                startActivity(intent);
            }
        });

        return view;
    }



    // Ecriture des données
    public void loadData() throws IOException, JSONException {

        // Lire le fichier json
        FileInputStream fileInputStream = getActivity().openFileInput(FILE_NAME);
        InputStreamReader inputStreamReader = new InputStreamReader(fileInputStream);
        BufferedReader bufferedReader = new BufferedReader(inputStreamReader);
        StringBuilder stringBuilder = new StringBuilder();
        String line;
        while ((line = bufferedReader.readLine()) != null) {
            stringBuilder.append(line);
        }
        fileInputStream.close();
        String json = stringBuilder.toString();
        // Afficher dans la console le contenu du fichier
        System.out.println("Contenu du fichier JSON dans le fichier "+ FILE_NAME + ": " + json);

        JSONObject jsonObject = new JSONObject(json);

        // On garde les données du nom et de l'anniversaire en modifiant les edit text
        nomField.setText(jsonObject.getString("nom"));
        anniversaireField.setText(jsonObject.getString("anniversaire"));
    }
}
