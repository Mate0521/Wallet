package repository

import modelo.res.EntradaRes
import modelo.Usuario
import network.RetrofitClient
import retrofit2.Call
import retrofit2.Callback
import retrofit2.Response

class UsuarioRep {
    private val api = RetrofitClient.api

    fun autenticar(usuario: Usuario, callback: (exito: Boolean, mensaje: String) -> Unit) {
        api.autenticarUsuario(usuario).enqueue(object : Callback<Map<String, Any>> {
            override fun onResponse(call: Call<Map<String, Any>>, response: Response<Map<String, Any>>) {
                val mensaje = response.body()?.get("mensaje") ?: "Sin respuesta"
                if (response.isSuccessful) {
                    callback(true, mensaje.toString())
                } else {
                    callback(false, mensaje.toString())
                }
            }
            override fun onFailure(call: Call<Map<String, Any>>, t: Throwable) {
                callback(false, "Error de conexión: ${t.message}")
            }
        })
    }

    fun entrar(usuario: Usuario, callback: (exito: Boolean, datos: EntradaRes?, mensaje: String) -> Unit) {
        api.traerDatos(usuario).enqueue(object : Callback<EntradaRes> {
            override fun onResponse(call: Call<EntradaRes>, response: Response<EntradaRes>) {
                if (response.isSuccessful) {
                    val datosCompletos = response.body()

                    // Ahora la comprobación es mucho más simple y segura
                    if (datosCompletos?.usuario != null && datosCompletos.cuenta != null) {
                        // Éxito: Pasamos el objeto completo directamente
                        callback(true, datosCompletos, "Datos obtenidos correctamente.")
                    } else {
                        // Fallo lógico: El usuario o la cuenta vinieron nulos
                        callback(false, null, "No se encontraron datos para este usuario.")
                    }
                } else {
                    // Error del servidor
                    callback(false, null, "Error del servidor: ${response.code()}")
                }
            }

            override fun onFailure(call: Call<EntradaRes>, t: Throwable) {
                // Error de red
                callback(false, null, "Error de conexión: ${t.message}")
            }
        })
    }
}