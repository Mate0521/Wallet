package repository

import data.modelo.res.EntradaRes
import data.modelo.req.Autenticacion
import data.modelo.req.Entrada
import data.network.RetrofitClient

class UsuarioRep {
    private val apiService = RetrofitClient.apiService

    suspend fun autenticar(autentificacion: Autenticacion): Result<Boolean> {
        // 2. El bloque try-catch ahora envuelve la expresión completa para manejar errores de red o de la API
        return try {
            val response = apiService.autenticarUsuario(autentificacion)

            if (response.isSuccessful) {
                Result.success(true)
            } else {
                // Devolvemos una excepción con un mensaje más descriptivo
                Result.failure(Exception("Credenciales no válidas (código: ${response.code()})"))
            }
        } catch (e: Exception) {
            // 3. El bloque catch ahora devuelve un resultado de fallo
            Result.failure(Exception("Error de conexión: ${e.message}"))
        }
    }

    suspend fun entrar(entrada: Entrada): Result<EntradaRes> {

        return runCatching {

            val datos = apiService.traerDatos(entrada)

            if (datos.usuario == null || datos.cuenta == null) {
                throw IllegalStateException("La respuesta del servidor está incompleta.")
            }

            datos
        }
    }
}