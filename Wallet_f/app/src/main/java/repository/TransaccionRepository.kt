package repository

import modelo.transaccion
import network.ApiService
import network.RetrofitClient
import retrofit2.Call


class TransaccionRepository {
    private val api = RetrofitClient.instance.create(ApiService::class.java)

    fun enviarTransaccion(transaccion: transaccion): Call<Map<String, Any>> {
        return api.transaccion(transaccion)
    }

}
