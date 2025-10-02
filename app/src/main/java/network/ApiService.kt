package network

import modelo.*
import retrofit2.Call
import retrofit2.http.Body
import retrofit2.http.POST

interface ApiService {

    @POST("autenticacion.php")
    fun autenticarUsuario(@Body usuario: usuario): Call<Map<String, Any>>

    @POST("cuenta.php")
    fun crearCuenta(@Body cuenta: cuenta):Call<Map<String, Any>>

    @POST("entrada.php")
    fun traerDatos(@Body usuario: usuario): Call<Map<String, Any>>



}