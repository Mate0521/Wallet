package ui.panel_control

import android.content.Intent
import android.os.Build
import android.os.Bundle
import android.view.View
import android.widget.Button
import android.widget.TextView
import android.widget.Toast
import androidx.activity.viewModels
import androidx.appcompat.app.AppCompatActivity
import androidx.core.view.ViewCompat
import androidx.core.view.WindowInsetsCompat
import com.example.wallet_f.R
import data.modelo.res.EntradaRes
import ui.forms.ConsignarAvtivity
import ui.forms.EnviarActivity
import ui.forms.RetirarAvtivity


class PanelControlActuvity : AppCompatActivity() {

    private val panelVM: PanelControlVM by viewModels()

    private lateinit var bnt_consignar: Button
    private lateinit var btn_retirar: Button
    private lateinit var btn_enviar: Button
    private lateinit var txt_monto: TextView
    private lateinit var txt_header1: TextView
    private lateinit var txt_subhead1: TextView
    private lateinit var txt_header2: TextView
    private lateinit var txt_subhead2: TextView
    private lateinit var txt_header3: TextView
    private lateinit var txt_subhead3: TextView


    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        setContentView(R.layout.activity_panel_control)

        ViewCompat.setOnApplyWindowInsetsListener(findViewById(R.id.panel_control)) { v, insets ->
            val systemBars = insets.getInsets(WindowInsetsCompat.Type.systemBars())
            v.setPadding(systemBars.left, systemBars.top, systemBars.right, systemBars.bottom)
            insets
        }

        inicializarComponentes()

        val entradaRes: EntradaRes? by lazy {
            if (Build.VERSION.SDK_INT >= Build.VERSION_CODES.TIRAMISU) {
                intent.getParcelableExtra("DATOS_ENTRADA", EntradaRes::class.java)
            } else {
                @Suppress("DEPRECATION")
                intent.getParcelableExtra<EntradaRes>("DATOS_ENTRADA")
            }
        }

        panelVM.cargarDatos(entradaRes?.usuario?.telefono.toString())


        listener(entradaRes)

        cargarHistirial(entradaRes)



        panelVM.uiState.observe(this) { uiState ->
            when (uiState) {
                is PanelState.Error -> {
                    Toast.makeText(this, uiState.message, Toast.LENGTH_LONG).show()
                    finish()
                }
                PanelState.Loading -> {
                    txt_monto.text = "..."
                    findViewById<View>(R.id.linearLayout).visibility = View.INVISIBLE
                    findViewById<View>(R.id.linearLayout2).visibility = View.INVISIBLE
                }
                is PanelState.Success -> {
                    findViewById<View>(R.id.linearLayout).visibility = View.VISIBLE
                    findViewById<View>(R.id.linearLayout2).visibility = View.VISIBLE

                    txt_monto.text = uiState.saldo.toString()

                    val movimientos = uiState.ultimosMovimientos

                    movimientos.getOrNull(0)?.let {
                        txt_header1.text = "$"
                        txt_subhead1.text = "destino"
                    }
                    movimientos.getOrNull(1)?.let {
                        txt_header2.text = "$"
                        txt_subhead2.text = "destino"
                    }
                    movimientos.getOrNull(2)?.let {
                        txt_header3.text = "$"
                        txt_subhead3.text = "destino"
                    }
                }
            }
        }

    }


    private fun inicializarComponentes() {
        btn_enviar=findViewById<Button>(R.id.btn_enviar)
        bnt_consignar=findViewById<Button>(R.id.btn_consignar)
        btn_retirar=findViewById<Button>(R.id.btn_retirar)
        txt_monto=findViewById<TextView>(R.id.txt_monto)
        txt_header1=findViewById<TextView>(R.id.txt_header1)
        txt_subhead1=findViewById<TextView>(R.id.txt_subhead1)
        txt_header2=findViewById<TextView>(R.id.txt_header2)
        txt_subhead2=findViewById<TextView>(R.id.txt_subhead2)
        txt_header3=findViewById<TextView>(R.id.txt_header3)
        txt_subhead3=findViewById<TextView>(R.id.txt_subhead3)
    }

    private fun listener(datos: EntradaRes?){
        btn_enviar.setOnClickListener {  //enviar a formulario de envio
            datos?.let {
                val intent = Intent(this, EnviarActivity::class.java)
                intent.putExtra("DATOS_ENTRADA", it)
                startActivity(intent)
            }
        }
        bnt_consignar.setOnClickListener { //mostrar codigo qr personal o por el momento el numero
            datos?.let {
                val intent = Intent(this, ConsignarAvtivity::class.java)
                intent.putExtra("DATOS_ENTRADA", it)
                startActivity(intent)
            }
        }
        btn_retirar.setOnClickListener { //mostrar codigo qr personal o por el momento el numero
            datos?.let {
                val intent = Intent(this, RetirarAvtivity::class.java)
                intent.putExtra("DATOS_ENTRADA", it)
                startActivity(intent)
            }
        }

    }

    private fun cargarHistirial(datos: EntradaRes?){

    }


}