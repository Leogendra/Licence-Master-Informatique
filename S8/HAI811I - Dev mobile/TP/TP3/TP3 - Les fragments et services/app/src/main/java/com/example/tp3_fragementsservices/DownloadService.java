package com.example.tp3_fragementsservices;

import android.app.Notification;
import android.app.NotificationChannel;
import android.app.NotificationManager;
import android.app.Service;
import android.content.Context;
import android.content.Intent;
import android.os.AsyncTask;
import android.os.Build;
import android.os.IBinder;
import android.util.Log;

import androidx.core.app.NotificationCompat;

import com.google.gson.Gson;

import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStreamReader;
import java.net.HttpURLConnection;
import java.net.URL;

import com.example.tp3_fragementsservices.JsonData;

public class DownloadService extends Service {
    private static final String TAG = DownloadService.class.getSimpleName();
    private static final int NOTIFICATION_ID = 1;
    public static final String ACTION_DOWNLOAD_COMPLETE = "com.example.tp3_fragementsservices.DOWNLOAD_COMPLETE";


    @Override
    public int onStartCommand(Intent intent, int flags, int startId) {
        String urlStr = intent.getStringExtra("url");
        if (urlStr == null) {
            stopSelf(); // Arrête le service si l'URL n'est pas fournie
            return START_NOT_STICKY;
        }

        // Start the service in the foreground
        Notification notification = createNotification();
        startForeground(NOTIFICATION_ID, notification);

        new DownloadJsonTask().execute(urlStr);
        return START_NOT_STICKY;
    }

    @Override
    public IBinder onBind(Intent intent) {
        return null;
    }

    private Notification createNotification() {
        String channelId = "download_service_channel";
        CharSequence channelName = "Download Service";
        NotificationCompat.Builder builder = new NotificationCompat.Builder(this, channelId)
                .setContentTitle("Téléchargement en cours")
                .setContentText("Téléchargement du fichier JSON...")
                .setSmallIcon(android.R.drawable.stat_sys_download)
                .setPriority(NotificationCompat.PRIORITY_LOW);

        if (Build.VERSION.SDK_INT >= Build.VERSION_CODES.O) {
            NotificationChannel channel = new NotificationChannel(channelId, channelName, NotificationManager.IMPORTANCE_LOW);
            NotificationManager notificationManager = (NotificationManager) getSystemService(Context.NOTIFICATION_SERVICE);
            if (notificationManager != null) {
                notificationManager.createNotificationChannel(channel);
            }
        }

        return builder.build();
    }

    private class DownloadJsonTask extends AsyncTask<String, Void, JsonData> {
        @Override
        protected JsonData doInBackground(String... params) {
            String urlStr = params[0];
            JsonData jsonData = null;

            try {
                URL url = new URL(urlStr);
                HttpURLConnection conn = (HttpURLConnection) url.openConnection();
                conn.setRequestMethod("GET");
                conn.setConnectTimeout(5000);
                conn.setReadTimeout(5000);
                conn.connect();

                int responseCode = conn.getResponseCode();
                if (responseCode == HttpURLConnection.HTTP_OK) {
                    BufferedReader reader = new BufferedReader(new InputStreamReader(conn.getInputStream()));
                    StringBuilder response = new StringBuilder();
                    String line;
                    while ((line = reader.readLine()) != null) {
                        response.append(line);
                    }
                    reader.close();

                    Gson gson = new Gson();
                    jsonData = gson.fromJson(response.toString(), JsonData.class);

                } else {
                    Log.e(TAG, "Error response code: " + responseCode);
                }
                conn.disconnect();
            } catch (IOException e) {
                Log.e(TAG, "Error while downloading JSON", e);
            }

            return jsonData;
        }

        @Override
        protected void onPostExecute(JsonData jsonData) {
            if (jsonData != null) {
                Log.d(TAG, "Données reçus : " + jsonData.toString());
                Intent intent = new Intent(ACTION_DOWNLOAD_COMPLETE);
                intent.putExtra("jsonData", jsonData);
                sendBroadcast(intent);
            }
            stopForeground(true);
            stopSelf();
        }

    }

}
