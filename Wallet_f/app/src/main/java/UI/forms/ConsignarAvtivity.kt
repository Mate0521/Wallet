package ui.forms

import android.content.ClipData
import android.content.ClipboardManager
import android.content.Context
import android.graphics.Bitmap
import android.graphics.Color
import android.os.Build
import android.os.Bundle
import android.widget.ImageButton
import android.widget.ImageView
import android.widget.TextView
import android.widget.Toast
import androidx.appcompat.app.AppCompatActivity
import androidx.core.view.ViewCompat
import androidx.core.view.WindowInsetsCompat
import com.example.wallet_f.R
import com.google.android.material.button.MaterialButton
import com.google.zxing.BarcodeFormat
import com.google.zxing.qrcode.QRCodeWriter
import data.modelo.res.EntradaRes

class ConsignarAvtivity : AppCompatActivity() {

    private lateinit var qr_user: ImageView
    private lateinit var tv_user_tel: TextView
    private lateinit var btn_listo: MaterialButton
    private lateinit var btn_copy: ImageButton


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
        setContentView(R.layout.activity_consignar)

        inicializarComponentes()

        ViewCompat.setOnApplyWindowInsetsListener(findViewById(R.id.consignar)) { v, insets ->
            val systemBars = insets.getInsets(WindowInsetsCompat.Type.systemBars())
            v.setPadding(systemBars.left, systemBars.top, systemBars.right, systemBars.bottom)
            insets
        }

        cargarDatos()

        listeners()

    }

    fun inicializarComponentes() {
        qr_user = findViewById(R.id.qr_user)
        tv_user_tel = findViewById(R.id.tv_user_tel)
        btn_listo = findViewById(R.id.btn_listo)
        btn_copy = findViewById(R.id.btn_copy_number)
    }

    private fun listeners() {
        btn_listo.setOnClickListener {
            finish()
        }

        btn_copy.setOnClickListener {
            val phoneNumber = tv_user_tel.text.toString()
            if (phoneNumber.isNotEmpty()) {
                // Obtenemos el servicio del sistema con la clase correcta
                val clipboard = getSystemService(Context.CLIPBOARD_SERVICE) as ClipboardManager
                val clip = ClipData.newPlainText("Número de teléfono", phoneNumber)

                clipboard.setPrimaryClip(clip)

                Toast.makeText(this, "Número copiado al portapapeles", Toast.LENGTH_SHORT).show()
            }
        }
    }


    private fun cargarDatos() {
        val phoneNumber = datosUser?.usuario?.telefono

        if (!phoneNumber.isNullOrBlank()) {
            tv_user_tel.text = phoneNumber
            val qrBitmap = generarCodigoQR(phoneNumber)
            qr_user.setImageBitmap(qrBitmap)
        } else {
            Toast.makeText(this, "Error: No se pudo cargar el número de teléfono.", Toast.LENGTH_LONG).show()
            tv_user_tel.text = "Número no disponible"
        }
    }

    private fun generarCodigoQR(texto: String): Bitmap? {
        val writer = QRCodeWriter()
        return try {
            val bitMatrix = writer.encode(texto, BarcodeFormat.QR_CODE, 512, 512)
            val width = bitMatrix.width
            val height = bitMatrix.height
            val bmp = Bitmap.createBitmap(width, height, Bitmap.Config.RGB_565)
            for (x in 0 until width) {
                for (y in 0 until height) {
                    bmp.setPixel(x, y, if (bitMatrix[x, y]) Color.BLACK else Color.WHITE)
                }
            }
            bmp
        } catch (e: Exception) {
            e.printStackTrace()
            null
        }
    }
}

