package com.example.tp3_fragementsservices;

import java.io.Serializable;

public class JsonData implements Serializable {
    private int userId, id;
    private String title;
    private boolean completed;

    // Getters et setters pour les champs

    public int getUserId() {
        return userId;
    }

    public void setUserId(int userId) {
        this.userId = userId;
    }

    public int getId() {
        return id;
    }

    public void setId(int id) {
        this.id = id;
    }

    public String getTitle() {
        return title;
    }

    public void setTitle(String title) {
        this.title = title;
    }

    public boolean isCompleted() {
        return completed;
    }

    public void setCompleted(boolean completed) {
        this.completed = completed;
    }

    @Override
    public String toString() {
        return "userId = " + userId +
                "\nid = " + id +
                "\ntitre = '" + title + '\'' +
                "\nvérifié = " + completed;
    }
}
