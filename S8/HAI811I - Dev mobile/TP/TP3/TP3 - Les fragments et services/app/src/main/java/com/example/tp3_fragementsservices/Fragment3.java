package com.example.tp3_fragementsservices;

import android.annotation.SuppressLint;
import android.content.BroadcastReceiver;
import android.content.Context;
import android.content.Intent;
import android.content.IntentFilter;
import android.os.AsyncTask;
import android.os.Bundle;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.Button;
import android.widget.TextView;

import androidx.core.content.ContextCompat;
import androidx.fragment.app.Fragment;

import java.io.BufferedInputStream;
import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStream;
import java.io.InputStreamReader;
import java.net.HttpURLConnection;
import java.net.URL;

import com.example.tp3_fragementsservices.JsonData;

public class Fragment3 extends Fragment {

    String URL_LINK = "https://jsonplaceholder.typicode.com/todos/1";
    String resultat;
    View view;
    TextView resultatTextView;
    BroadcastReceiver downloadCompleteReceiver;

    public Fragment3() {}

    @Override
    @SuppressLint({"MissingInflatedId", "SetTextI18n"})
    public View onCreateView(LayoutInflater inflater, ViewGroup container, Bundle savedInstanceState) {

        // Association de la vue au fragment 3
        view = inflater.inflate(R.layout.fragment_3, container, false);

        // EXERCICE 4 : Utilisation du service
        Intent intent = new Intent(getActivity(), DownloadService.class);
        intent.putExtra("url", URL_LINK);
        ContextCompat.startForegroundService(getActivity(), intent);

        // Recuperation des informations du ficheir du site
        downloadCompleteReceiver = new BroadcastReceiver() {
            @Override
            public void onReceive(Context context, Intent intent) {
                if (DownloadService.ACTION_DOWNLOAD_COMPLETE.equals(intent.getAction())) {
                    JsonData jsonData = (JsonData) intent.getSerializableExtra("jsonData");
                    if (jsonData != null) {
                        TextView resultatTextView = view.findViewById(R.id.resultat_textView);
                        resultatTextView.setText(R.string.info_site);
                        TextView siteTextView = view.findViewById(R.id.site_textView);
                        siteTextView.setText(URL_LINK);
                        TextView infoTextView = view.findViewById(R.id.info_textView);
                        infoTextView.setText(""+ jsonData);
                    }
                }
            }
        };

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


    // EXERCICE 3 : qu'on n'utilise pas car c'est le service qui est en marche

    // Telechargement des informations du site
    @SuppressLint("StaticFieldLeak")
    private class DownloadFileTask extends AsyncTask<String, Void, String> {

        @Override
        protected String doInBackground(String... urls) {
            String response = "";
            HttpURLConnection urlConnection = null;
            try {
                // Recuperation de l'URL du site
                URL url = new URL(urls[0]);
                urlConnection = (HttpURLConnection) url.openConnection();
                InputStream in = new BufferedInputStream(urlConnection.getInputStream());
                response = convertInputStreamToString(in);
            }
            catch (Exception e) {
                Log.e("Error", e.getMessage());
            }
            finally {
                if (urlConnection != null) {
                    urlConnection.disconnect();
                }
            }
            return response;
        }

        @Override
        protected void onPostExecute(String result) {
            resultat = result;
            resultatTextView = view.findViewById(R.id.resultat_textView);
            resultatTextView.setText("Informations du site : \n\n https://jsonplaceholder.typicode.com/todos/1\n\n"+resultat);
        }
    }


    // Conversion du ficheir en string
    private static String convertInputStreamToString(InputStream inputStream) throws IOException {
        BufferedReader bufferedReader = new BufferedReader(new InputStreamReader(inputStream));
        StringBuilder stringBuilder = new StringBuilder();
        String line;
        while ((line = bufferedReader.readLine()) != null) {
            stringBuilder.append(line).append("\n");
        }
        bufferedReader.close();
        return stringBuilder.toString();
    }

    @Override
    public void onResume() {
        super.onResume();
        IntentFilter intentFilter = new IntentFilter(DownloadService.ACTION_DOWNLOAD_COMPLETE);
        getActivity().registerReceiver(downloadCompleteReceiver, intentFilter);
    }


    @Override
    public void onPause() {
        super.onPause();
        getActivity().unregisterReceiver(downloadCompleteReceiver);
    }

}