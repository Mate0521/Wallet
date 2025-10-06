package ui.login


import androidx.lifecycle.LiveData
import androidx.lifecycle.MutableLiveData
import androidx.lifecycle.ViewModel
import androidx.lifecycle.viewModelScope
import data.modelo.req.Autenticacion
import data.modelo.req.Entrada
import data.modelo.res.EntradaRes
import kotlinx.coroutines.launch
import repository.UsuarioRep

sealed class LoginState {
    object Idle : LoginState()
    object Espera : LoginState() // Representa el estado de carga
    // Éxito ahora transporta el objeto de respuesta completo
    data class Aprovado(val datos: EntradaRes) : LoginState()
    data class Error(val message: String) : LoginState()
}

class LoginVM : ViewModel() {
    // Acceso al Repositorio
    private val repo = UsuarioRep()

    // Estado privado y mutable que solo el ViewModel puede modificar
    // (Usando la convención de nombres con guion bajo)
    private val _state = MutableLiveData<LoginState>(LoginState.Idle)

    // Estado público e inmutable que la UI (Activity) observará
    val uiState: LiveData<LoginState> = _state

    fun onLoginClick(telefono: String, clave: String) {

        if (telefono.isBlank() || clave.isBlank()) {
            _state.value = LoginState.Error("Por favor, completa todos los campos.")
            return
        }

        // Inicia una corrutina para realizar el trabajo de red en segundo plano
        viewModelScope.launch() {

            _state.value = LoginState.Espera

            val authResult = repo.autenticar(Autenticacion(telefono, clave))

            authResult.onSuccess {
                //  traemos los datos del usuario
                usuarioData(telefono)
            }.onFailure { error ->
                // notificar a la UI con el mensaje de error
                _state.value = LoginState.Error(error.message ?: "Credenciales incorrectas")
            }
        }
    }

    private suspend fun usuarioData(telefono: String) {
        // Asumiendo que el endpoint de 'entrada' también necesita las credenciales.
        val entradaRequest = Entrada(telefono)
        val dataResult = repo.entrar(entradaRequest)

        dataResult.onSuccess { data ->
            _state.value = LoginState.Aprovado(data)
        }.onFailure { error ->
            _state.value = LoginState.Error(error.message ?: "Error al obtener los datos del usuario.")
        }
    }
}