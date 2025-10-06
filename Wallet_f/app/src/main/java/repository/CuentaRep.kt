package repository

import data.modelo.Transaccion
import data.modelo.req.Historial
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
}

