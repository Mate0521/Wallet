package ui.panel_control

import android.os.Bundle
import android.widget.Button
import android.widget.EditText
import android.widget.ProgressBar
import android.widget.TextView
import androidx.activity.viewModels
import androidx.appcompat.app.AppCompatActivity
import androidx.core.view.ViewCompat
import androidx.core.view.WindowInsetsCompat
import androidx.lifecycle.Observer
import com.example.wallet_f.R
import ui.login.LoginVM


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

        ViewCompat.setOnApplyWindowInsetsListener(findViewById(R.id.main)) { v, insets ->
            val systemBars = insets.getInsets(WindowInsetsCompat.Type.systemBars())
            v.setPadding(systemBars.left, systemBars.top, systemBars.right, systemBars.bottom)
            insets
        }

        btn_enviar.setOnClickListener {  }
        bnt_consignar.setOnClickListener {  }
        btn_retirar.setOnClickListener {  }

        panelVM.uiState.observe(this) { uiState ->
            when(uiState){
                is PanelState.Error -> TODO()
                PanelState.Loading -> TODO()
                is PanelState.Success -> TODO()
            }
        }

    }


}