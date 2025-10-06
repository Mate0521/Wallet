package ui.panel_control

import androidx.lifecycle.LiveData
import androidx.lifecycle.MutableLiveData
import androidx.lifecycle.ViewModel
import androidx.lifecycle.viewModelScope
import data.modelo.Transaccion
import data.modelo.res.EntradaRes
import kotlinx.coroutines.launch
import repository.CuentaRep

sealed class PanelState {
    object Loading : PanelState() // Muestra un shimmer o ProgressBar mientras se cargan los datos.
    data class Success(
        val nombreUsuario: String,
        val saldo: Double,
        val ultimosMovimientos: List<Transaccion>
    ) : PanelState()
    data class Error(val message: String) : PanelState()
}

class PanelControlVM : ViewModel()
{
    // Acceso al Repositorio
    private val repo= CuentaRep()
    //estado del que se modifica de vm
    private val _uiState = MutableLiveData<PanelState>()
    //lo que ve la activity
    val uiState: LiveData<PanelState> = _uiState

    fun cargarDatos(datos: EntradaRes)
    {
        if (datos.usuario != null && datos.cuenta != null)
        {
            _uiState.value= PanelState.Error("No se recibieron los datos")
            return
        }
        viewModelScope.launch{
            _uiState.value= PanelState.Loading
            try
            {
                val historial = repo.traerHistorial(datos.cuenta?.id)

                _uiState.value= PanelState.Success(
                    datos.usuario?.nombre.toString(),
                    datos.cuenta?.saldo.toString().toDouble(),
                    historial.getOrNull() ?: emptyList()
                )

            }catch (e: Exception){

            }
        }
    }
}