package UI

import android.content.Intent
import android.os.Bundle
import android.widget.*
import androidx.appcompat.app.AppCompatActivity
import androidx.core.view.WindowInsetsCompat
import androidx.core.view.ViewCompat
import data.modelo.Usuario
import repository.UsuarioRep
import com.example.wallet_f.R

class LoginActivity : AppCompatActivity() {

    private val repo = UsuarioRep()

    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        setContentView(R.layout.activity_login)

        val edt_cel = findViewById<EditText>(R.id.edt_cel)
        val edt_pass = findViewById<EditText>(R.id.editTextNumberPassword)
        val btnIngresar = findViewById<Button>(R.id.btnIngresar)

        ViewCompat.setOnApplyWindowInsetsListener(findViewById(R.id.main)) { v, insets ->
            val systemBars = insets.getInsets(WindowInsetsCompat.Type.systemBars())
            v.setPadding(systemBars.left, systemBars.top, systemBars.right, systemBars.bottom)
            insets
        }

        btnIngresar.setOnClickListener {
            val telefono = edt_cel.text.toString().trim()
            val clave = edt_pass.text.toString().trim()

            if (telefono.isEmpty() || clave.isEmpty()) {
                Toast.makeText(this, "Completa todos los campos", Toast.LENGTH_SHORT).show()
                return@setOnClickListener
            }

            val usuario = Usuario("", "", "", "",telefono, clave)

            repo.autenticar(usuario) { exito, mensaje ->
                runOnUiThread {
                    Toast.makeText(this, mensaje, Toast.LENGTH_SHORT).show()

                    if (exito) {
                        repo.entrar(usuario) { exito, datos, mensaje ->

                            runOnUiThread {
                                if (exito && datos != null) {
                                    // ¡ÉXITO! Acceso directo, seguro y autocompletado por el IDE
                                    val nombreUsuario = datos.usuario?.nombre ?: "Sin nombre"
                                    val saldoCuenta = datos.cuenta?.saldo ?: "0.0"

                                    Toast.makeText(
                                        this,
                                        "¡Bienvenido, $nombreUsuario! Tu saldo es: $saldoCuenta",
                                        Toast.LENGTH_LONG
                                    ).show()

                                    // Navegar a la siguiente pantalla...
                                    val intent = Intent(this, MainActivity::class.java)
                                    // Ya no necesitas pasar los datos uno por uno si la siguiente Activity no los necesita
                                    startActivity(intent)
                                    finish()

                                } else {
                                    // FALLO
                                    Toast.makeText(this, mensaje, Toast.LENGTH_LONG).show()
                                }
                            }
                        }

                    }
                }
            }
        }
    }
}
