package ui.forms

import androidx.lifecycle.LiveData
import androidx.lifecycle.MutableLiveData
import androidx.lifecycle.ViewModel
import androidx.lifecycle.viewModelScope
import data.modelo.req.TransaccionReq
import kotlinx.coroutines.launch
import repository.TransaccionRep


sealed class FormsState {
    object Espera : FormsState() // Representa el estado de carga
    object Aprovado: FormsState()
    data class Error(val message: String) : FormsState()
}

class formsVM : ViewModel() {
    private val repo = TransaccionRep()

    private val _state = MutableLiveData<FormsState>()

    val uiState: LiveData<FormsState> = _state

    fun enviar(transaccion: TransaccionReq){
        // Verifica que los datos no sean nulos o vacíos
        if (transaccion.destino.isNullOrBlank() || transaccion.id_cuenta.isNullOrBlank()) {
            _state.value = FormsState.Error("Todos los campos son obligatorios.")
            return
        }
        transaccion.id_tipo = "1"
        viewModelScope.launch {
            _state.value = FormsState.Espera
            val enviarResult = repo.movimiento(transaccion)
        }
    }

    fun retirar(transaccion: TransaccionReq){
        if ( transaccion.destino.isNullOrBlank() || transaccion.id_cuenta.isNullOrBlank()) {
            _state.value = FormsState.Error("Todos los campos son obligatorios.")
            return
        }
        transaccion.id_tipo = "5"
        viewModelScope.launch {
            _state.value = FormsState.Espera
            val enviarResult = repo.movimiento(transaccion)
        }

    }
    fun consignar(transaccion: TransaccionReq){
        if ( transaccion.destino.isNullOrBlank() || transaccion.id_cuenta.isNullOrBlank()) {
            _state.value = FormsState.Error("Todos los campos son obligatorios.")
            return
        }
        transaccion.id_tipo = "7"
        viewModelScope.launch {
            _state.value = FormsState.Espera
            val enviarResult = repo.movimiento(transaccion)
        }

    }

}