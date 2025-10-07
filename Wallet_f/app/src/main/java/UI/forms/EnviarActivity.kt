package ui.forms

import android.os.Build
import android.os.Bundle
import android.widget.Button
import android.widget.TextView
import android.widget.Toast
import androidx.activity.viewModels
import androidx.appcompat.app.AppCompatActivity
import androidx.core.view.ViewCompat
import androidx.core.view.WindowInsetsCompat
import com.example.wallet_f.R
import data.modelo.req.TransaccionReq
import data.modelo.res.EntradaRes
import ui.login.LoginState


class EnviarActivity : AppCompatActivity()
{
    private val forms: formsVM by viewModels()

    private lateinit var btn_enviar: Button
    private lateinit var et_telefono: TextView
    private lateinit var et_monto: TextView

    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        setContentView(R.layout.activity_enviar)

        inicializarComponentes()

        ViewCompat.setOnApplyWindowInsetsListener(findViewById(R.id.enviar)) { v, insets ->
            val systemBars = insets.getInsets(WindowInsetsCompat.Type.systemBars())
            v.setPadding(systemBars.left, systemBars.top, systemBars.right, systemBars.bottom)
            insets
        }

        val datosUser: EntradaRes? by lazy {
            if (Build.VERSION.SDK_INT >= Build.VERSION_CODES.TIRAMISU) {
                intent.getParcelableExtra("DATOS", EntradaRes::class.java)
            } else {
                @Suppress("DEPRECATION")
                intent.getParcelableExtra<EntradaRes>("DATOS")
            }
        }

        btn_enviar.setOnClickListener {
            if (et_telefono.text.toString().isBlank() || et_monto.text.toString().isBlank()) {
                Toast.makeText(this, "Por favor, completa todos los campos", Toast.LENGTH_SHORT).show()
                return@setOnClickListener
            }

            val transaccion: TransaccionReq = TransaccionReq(
                id_cuenta = datosUser?.cuenta?.id.toString(),
                monto = et_monto.text.toString().toDouble(),
                destino = et_telefono.text.toString(),
                id_tipo = ""
            )

            forms.enviar(transaccion)
        }

        forms.uiState.observe(this){ uiState ->
            when(uiState){
                FormsState.Aprovado -> TODO()
                is FormsState.Error -> TODO()
                FormsState.Espera -> TODO()
                FormsState.Idle -> TODO()
            }
        }



    }
    private fun inicializarComponentes() {
        btn_enviar = findViewById<Button>(R.id.btnEnviar)
        et_telefono = findViewById<TextView>(R.id.et_telefono)
        et_monto = findViewById<TextView>(R.id.et_monto)
    }
}