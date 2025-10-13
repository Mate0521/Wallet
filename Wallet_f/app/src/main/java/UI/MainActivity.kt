package ui

import android.content.Intent
import android.os.Bundle
import androidx.appcompat.app.AppCompatActivity
import ui.login.LoginActivity

class MainActivity : AppCompatActivity() {
    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        initApp();
    }

    public fun initApp(){
        val intent = Intent(this, LoginActivity::class.java);
        startActivity(intent);
    }
}