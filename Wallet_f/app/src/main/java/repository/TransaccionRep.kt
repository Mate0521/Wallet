package repository

import data.modelo.req.TransaccionReq
import data.modelo.res.Mensaje
import data.network.RetrofitClient
import java.io.IOException

class TransaccionRep {
    private val apiService = RetrofitClient.apiService

    suspend fun movimiento(transaccion : TransaccionReq): Result<String> {
        return try {
            val respuesta: Mensaje = apiService.registrarTransaccion(transaccion)

            if (respuesta.exito) {
                Result.success(respuesta.mensaje ?: "Operación completada")
            } else {
                Result.failure(IOException(respuesta.mensaje ?: "Error desconocido en la transacción"))
            }

        } catch (e: Exception) {
            Result.failure(e)
        }
    }
}