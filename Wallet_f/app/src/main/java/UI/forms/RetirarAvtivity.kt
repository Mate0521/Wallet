package ui.forms

import android.app.Activity
import android.os.Build
import android.os.Bundle
import android.widget.Button
import android.widget.EditText
import android.widget.TextView
import android.widget.Toast
import androidx.activity.viewModels
import androidx.appcompat.app.AppCompatActivity
import androidx.core.view.ViewCompat
import androidx.core.view.WindowInsetsCompat
import com.example.wallet_f.R
import data.modelo.req.TransaccionReq
import data.modelo.res.EntradaRes
import kotlin.getValue
import kotlin.random.Random

class RetirarAvtivity : AppCompatActivity(){
    private val forms: formsVM by viewModels()

    private lateinit var btn_retirar: Button
    private lateinit var et_retirar: EditText
    private lateinit var txt_saldo: TextView
    private lateinit var txt_codigo_al: TextView

    val datosUser: EntradaRes? by lazy {
        if (Build.VERSION.SDK_INT >= Build.VERSION_CODES.TIRAMISU) {
            intent.getParcelableExtra("DATOS_ENTRADA", EntradaRes::class.java)
        } else {
            @Suppress("DEPRECATION")
            intent.getParcelableExtra<EntradaRes>("DATOS_ENTRADA")
        }
    }

    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        setContentView(R.layout.activity_retirar)

        inicializarComponentes()

        ViewCompat.setOnApplyWindowInsetsListener(findViewById(R.id.retirar_dinero)) { v, insets ->
            val systemBars = insets.getInsets(WindowInsetsCompat.Type.systemBars())
            v.setPadding(systemBars.left, systemBars.top, systemBars.right, systemBars.bottom)
            insets
        }

        txt_saldo.text="$ ${datosUser?.cuenta?.saldo}"
        txt_codigo_al.text= " ${Random.nextInt(0, 100)}"

        btn_retirar.setOnClickListener {
            if (et_retirar.text.toString().isBlank()) {
                Toast.makeText(this, "Por favor,ingrese el valor a retirar", Toast.LENGTH_SHORT).show()
                return@setOnClickListener
            }

            val transaccion: TransaccionReq = TransaccionReq(
                id_cuenta = datosUser?.cuenta?.id_cuenta.toString(),
                monto = et_retirar.text.toString().toDouble(),
                destino = datosUser?.usuario?.telefono.toString(),
                tipo = ""
            )

            forms.retirar(transaccion)
        }

        forms.uiState.observe(this){ uiState ->
            when (uiState) {
                is FormsState.Aprovado -> {
                    // ÉXITO: La transacción fue aprobada
                    Toast.makeText(this, "La transacción fue aprobada", Toast.LENGTH_LONG).show()

                    setResult(Activity.RESULT_OK)
                    finish()
                }
                is FormsState.Error -> {
                    Toast.makeText(this, "Error", Toast.LENGTH_LONG).show()
                }
                // Los casos Espera e Idle ya se manejan arriba, no es necesario hacer nada más.
                FormsState.Espera, FormsState.Idle -> { }
            }
        }
    }

    fun inicializarComponentes(){
        btn_retirar = findViewById(R.id.btn_retirar)
        et_retirar = findViewById(R.id.et_retirar)
        txt_saldo = findViewById(R.id.txt_saldo)
        txt_codigo_al = findViewById(R.id.txt_codigo_al)

    }
}