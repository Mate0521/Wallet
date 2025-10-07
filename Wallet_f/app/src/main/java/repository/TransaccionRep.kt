package repository

import data.modelo.req.TransaccionReq
import data.network.RetrofitClient

class TransaccionRep {
    private val apiService = RetrofitClient.apiService

    suspend fun movimiento(transaccion : TransaccionReq): Result<Boolean>{
        return try {
            val response = apiService.registrarTransaccion(transaccion)

            if (response.isSuccessful) {
                Result.success(true)
            } else {
                Result.failure(Exception("presenta algun error (código: ${response.code()})"))
            }
        } catch (e: Exception) {
            Result.failure(Exception("Error de conexión: ${e.message}"))
        }
    }
}