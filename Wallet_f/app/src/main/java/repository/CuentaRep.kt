package repository

import data.modelo.Transaccion
import data.modelo.req.Entrada
import data.modelo.req.Historial
import data.modelo.res.EntradaRes
import data.network.RetrofitClient

class CuentaRep {
    private val apiService = RetrofitClient.apiService

    suspend fun traerHistorial(idCuenta: String?): Result<List<Transaccion>> {
        // Validación de entrada
        if (idCuenta.isNullOrBlank()) {
            return Result.failure(IllegalArgumentException("El id de la cuenta no puede ser nulo o vacío."))
        }

        return try {
            // Llamada directa a la función suspend de la API
            val response = apiService.obtenerHistorial(historial = Historial(idCuenta))

            if (response.isSuccessful && response.body() != null) {
                Result.success(response.body()!!)
            } else {
                Result.failure(Exception("Error del servidor: ${response.code()}"))
            }
        } catch (e: Exception) {
            // Fallo: error de red (sin conexión, timeout, etc.)
            Result.failure(Exception("Error de conexión: ${e.message}"))
        }
    }
    suspend fun cargarSaldo(tel: String?): Result<EntradaRes> {
        // Validación de entrada
        return runCatching {

            val datos = apiService.traerDatos(entrada = Entrada(tel.toString()))

            if (datos.usuario == null || datos.cuenta == null) {
                throw IllegalStateException("La respuesta del servidor está incompleta.")
            }
            datos
        }
    }
}

