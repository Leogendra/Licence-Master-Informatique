package com.example.tp3_fragementsservices;

import android.annotation.SuppressLint;
import android.content.Intent;
import android.os.Bundle;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.Button;
import android.widget.TextView;

import androidx.fragment.app.Fragment;

public class Fragment4 extends Fragment {

    public Fragment4() {}

    @Override
    @SuppressLint({"MissingInflatedId", "SetTextI18n"})
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
        // Associé la vue au fragment 4
        View view = inflater.inflate(R.layout.fragment_4, container, false);

        // Recuperation des info du bundle
        Bundle bundle = getArguments();
        assert bundle != null;
        String prenomString = bundle.getString("prenom");
        String nomString = bundle.getString("nom");
        String anniversaireString = bundle.getString("anniversaire");
        String telephoneString = bundle.getString("telephone");
        String emailString = bundle.getString("mail");
        String interetsString = bundle.getString("interests");

        // Afficher les données dans les TextView correspondants
        TextView nameTextView = view.findViewById(R.id.nomComplet);
        nameTextView.setText("Nom complet : " + prenomString + nomString);
        TextView annivTextView = view.findViewById(R.id.anniversaire);
        annivTextView.setText("Date d'anniversaire : " +anniversaireString);
        TextView telephoneTextView = view.findViewById(R.id.telephone);
        telephoneTextView.setText("Numéro de téléphone : " + telephoneString);
        TextView emailTextView = view.findViewById(R.id.mail);
        emailTextView.setText("Email : " + emailString);
        TextView interetsTextView = view.findViewById(R.id.interets);
        interetsTextView.setText("Centres d'intérêts : " + interetsString);

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
}