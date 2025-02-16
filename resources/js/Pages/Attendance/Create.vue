<script setup>
import { ref, onMounted } from 'vue';
import { QrcodeStream, QrcodeDropZone, QrcodeCapture } from 'vue-qrcode-reader'
import Swal from 'sweetalert2'

/* const personData = ref({
    name: 'Juan Pérez',
    plan: 'Plan Premium',
    isDelinquent: false,
}); */

const personData = ref({});
const isLoading = ref(false);

const videoElement = ref(null);


/*** select camera ***/

const selectedDevice = ref(null)
const devices = ref([])

/* onMounted(async () => {
    devices.value = (await navigator.mediaDevices.enumerateDevices()).filter(
        ({ kind }) => kind === 'videoinput'
    )

    if (devices.value.length > 0) {
        selectedDevice.value = devices.value[0]
    }
}) */

  const trackFunctionOptions = [
  { text: 'nothing (default)', value: undefined },
  { text: 'outline', value: paintOutline },
  { text: 'centered text', value: paintCenterText },
  { text: 'bounding box', value: paintBoundingBox }
]
const trackFunctionSelected = ref(trackFunctionOptions[1])


/*** error handling ***/

const error = ref('')

function onError(err) {
    error.value = `[${err.name}]: `

    const triedFrontCamera = facingMode.value === 'user';
    const triedRearCamera = facingMode.value === 'environment';

    const cameraMissingError = err.value === 'OverconstrainedError'


    if (triedFrontCamera && !cameraMissingError) {
        noRearCamera.value = true
    }

    if (triedRearCamera && !cameraMissingError) {
        noFrontCamera.value = true
    }

    //console.error(error)

  if (err.name === 'NotAllowedError') {
    error.value += 'you need to grant camera access permission'
  } else if (err.name === 'NotFoundError') {
    error.value += 'no camera on this device'
  } else if (err.name === 'NotSupportedError') {
    error.value += 'secure context required (HTTPS, localhost)'
  } else if (err.name === 'NotReadableError') {
    error.value += 'is the camera already in use?'
  } else if (err.name === 'OverconstrainedError') {
    error.value += 'installed cameras are not suitable'
  } else if (err.name === 'StreamApiNotSupportedError') {
    error.value += 'Stream API is not supported in this browser'
  } else if (err.name === 'InsecureContextError') {
    error.value +=
      'Camera access is only permitted in secure context. Use HTTPS or localhost rather than HTTP.'
  } else {
    error.value += err.message
  }
}

/*** track functons ***/

function paintOutline(detectedCodes, ctx) {
  for (const detectedCode of detectedCodes) {
    const [firstPoint, ...otherPoints] = detectedCode.cornerPoints

    ctx.strokeStyle = 'red'

    ctx.beginPath()
    ctx.moveTo(firstPoint.x, firstPoint.y)
    for (const { x, y } of otherPoints) {
      ctx.lineTo(x, y)
    }
    ctx.lineTo(firstPoint.x, firstPoint.y)
    ctx.closePath()
    ctx.stroke()
  }
}
function paintBoundingBox(detectedCodes, ctx) {
  for (const detectedCode of detectedCodes) {
    const {
      boundingBox: { x, y, width, height }
    } = detectedCode

    ctx.lineWidth = 2
    ctx.strokeStyle = '#007bff'
    ctx.strokeRect(x, y, width, height)
  }
}
function paintCenterText(detectedCodes, ctx) {
  for (const detectedCode of detectedCodes) {
    const { boundingBox, rawValue } = detectedCode

    const centerX = boundingBox.x + boundingBox.width / 2
    const centerY = boundingBox.y + boundingBox.height / 2

    const fontSize = Math.max(12, (50 * boundingBox.width) / ctx.canvas.width)

    ctx.font = `bold ${fontSize}px sans-serif`
    ctx.textAlign = 'center'

    ctx.lineWidth = 3
    ctx.strokeStyle = '#35495e'
    ctx.strokeText(detectedCode.rawValue, centerX, centerY)

    ctx.fillStyle = '#5cb984'
    ctx.fillText(rawValue, centerX, centerY)
  }
}

const onDetect = async (result) => {
    const code = result[0].rawValue
    try {
        isLoading.value = true;
        error.value = '';
        const response = await axios.post(route('attendance.store'), { code });
        personData.value.name = response.data.user.name;
        personData.value.plan_name = response.data.user.plan_name;
        personData.value.is_moroso = response.data.user.is_moroso;
        personData.value.id_number = response.data.user.id_number;
        personData.value.attendance_count = response.data.user.attendance_count;

        if (response.data.error) {
            error.value = response.data.message;
            //isLoading.value = false;
            Swal.fire({
                title: 'Error',
                text: response.data.message,
                icon: 'error',
            });
        }

    } catch (err) {
        console.error('Error al registrar asistencia:', err);
        error.value = 'Usuario no encontrado o error en el registro';
        isLoading.value = false;
    }
}
</script>

<template>
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900 flex flex-col items-center justify-center p-4 lg:flex-col lg:items-center lg:gap-4">
        <img src="/images/logosmall2.png" alt="Logo" class="w-24 h-24 mb-4 lg:w-20 lg:h-20" />

        <div class="flex flex-col w-full max-w-2xl lg:flex-row lg:w-3/4 lg:items-start md:gap-1">
            <div class="bg-white dark:bg-gray-800 shadow rounded-lg w-full flex justify-center items-center aspect-video lg:w-2/3">
                <div class="p-6 mb-8">
                <h2 class="mb-5 text-lg font-medium text-gray-900">
                    Escanear Codigo QR
                </h2>

                <p class="error">{{ error }}</p>

                <p
                    class="error"
                    v-if="noFrontCamera"
                >
                    You don't seem to have a front camera on your device
                </p>

                <p
                    class="error"
                    v-if="noRearCamera"
                >
                You don't seem to have a rear camera on your device
                </p>

                <div class="flex flex-col items-center justify-center gap-5">
                    <qrcode-stream
                      :track="trackFunctionSelected.value"
                      @error="onError"
                      @detect="onDetect"
                    >
                    <button @click="switchCamera" class="switchCamera">
                        <img
                        src="/images/camera.svg"
                        alt="switch camera"
                        class="w-3 h-3"
                        />
                    </button>
                    </qrcode-stream>

                </div>
            </div>
            </div>

            <div class="mt-4 bg-white dark:bg-gray-800 shadow rounded-lg p-4 w-full text-center lg:w-1/3 lg:mt-0" v-if="isLoading">
                <p class="text-base text-gray-700 dark:text-gray-300"><strong>Cedula:</strong> {{ personData.id_number }}</p>
                <p class="text-base text-gray-700 dark:text-gray-300"><strong>Nombre:</strong> {{ personData.name }}</p>
                <p class="text-base text-gray-700 dark:text-gray-300"><strong>Plan:</strong> {{ personData.plan_name }}</p>
                <p
                    class="text-base"
                    :class="personData.is_moroso ? 'text-red-500' : 'text-green-500'"
                >
                    <strong>Estado:</strong> {{ personData.is_moroso ? 'Moroso' : 'Al día' }}
                </p>
                <p class="text-base text-gray-700 dark:text-gray-300"><strong>Asistencias:</strong> {{ personData.attendance_count }}</p>
            </div>
        </div>
    </div>
</template>

<style scoped>

    .switchCamera {
        position: absolute;
        left: 10px;
        top: 10px;
        color : red;

    }
    .switchCamera img {
        width: 30px;
        height: 30px;
    }
    .error {
        color: red;
        font-weight: bold;
    }
</style>
