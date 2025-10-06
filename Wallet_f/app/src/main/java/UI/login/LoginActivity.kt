package ui.login

import android.os.Bundle
import android.content.Intent
import android.view.View
import android.widget.Button
import android.widget.EditText
import android.widget.ProgressBar
import android.widget.Toast
import androidx.activity.viewModels
import androidx.appcompat.app.AppCompatActivity
import androidx.core.view.ViewCompat
import androidx.core.view.WindowInsetsCompat
import com.example.wallet_f.R
import data.modelo.req.Autenticacion
import data.modelo.res.EntradaRes
import ui.panel_control.PanelControlActuvity

class LoginActivity : AppCompatActivity() {

    private val loginVM: LoginVM by viewModels()

    private lateinit var edt_cel: EditText
    private lateinit var edt_pass: EditText
    private lateinit var btn_ingresar: Button
    private lateinit var progress: ProgressBar

    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        setContentView(R.layout.activity_login)

        edt_cel = findViewById<EditText>(R.id.edt_cel)
        edt_pass = findViewById<EditText>(R.id.editTextNumberPassword)
        btn_ingresar = findViewById<Button>(R.id.btn_ingresar)
        progress = findViewById(R.id.progress)

        ViewCompat.setOnApplyWindowInsetsListener(findViewById(R.id.main)) { v, insets ->
            val systemBars = insets.getInsets(WindowInsetsCompat.Type.systemBars())
            v.setPadding(systemBars.left, systemBars.top, systemBars.right, systemBars.bottom)
            insets
        }
        btn_ingresar.setOnClickListener {
            loginVM.onLoginClick(edt_cel.text.toString().trim(), edt_pass.text.toString().trim())
        }

        loginVM.uiState.observe(this) { state ->
            when(state){
                is LoginState.Aprovado -> {
                    progress.visibility= View.GONE
                    btn_ingresar.isEnabled= true
                    Toast.makeText(this, "Bienbenidoo, ${state.datos.usuario?.nombre}", Toast.LENGTH_SHORT).show()
                    navInApp(state.datos)
                }
                is LoginState.Error -> {
                    progress.visibility= View.GONE
                    btn_ingresar.isEnabled= true
                    Toast.makeText(this, state.message, Toast.LENGTH_SHORT).show()
                }
                LoginState.Espera -> {
                    progress.visibility= View.VISIBLE
                    btn_ingresar.isEnabled= false
                }
                LoginState.Idle -> {
                    progress.visibility= View.GONE
                    btn_ingresar.isEnabled= true
                }
            }
        }



    }

    fun navInApp(datos: EntradaRes) {
        val intent = Intent(this, PanelControlActuvity::class.java)
        intent.putExtra("DATOS_ENTRADA", datos)
        startActivity(intent)
        finish()
    }
}
