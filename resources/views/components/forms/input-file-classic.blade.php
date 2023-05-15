<div x-data="imageViewer()" {{ $attributes->merge(['class' => "my-2 flex flex-col gap-1"])}} >

    <label for="icone">{{ $label }}</label>
    
    <template x-if="imageUrl">

        <img :src="imageUrl"
                class="object-cover rounded border border-gray-200"
                style="width: 100px; height: 100px;"
        >

    </template>

    <template x-if="!imageUrl">

        <div
                class="object-cover rounded border border-gray-200 bg-gray-200"
                style="width: 100px; height: 100px;"
        ></div>

    </template>

        <input accept="image/*" @change="fileChosen" class="border-2 text-gray-400 p-2 " type="file" name="icone" value="choisir">
    </div>

    <script>
        function imageViewer() {

            return {
                imageUrl: '',

                fileChosen(event) {
                    this.fileDataToUrl(event, src => this.imageUrl = src)
                },

                fileDataToUrl(event, callback) {
                    if( ! event.target.files.length) return

                    let file = event.target.files[0]
                        reader = new FileReader()

                    reader.readAsDataURL(file)
                    reader.onload = e => callback(e.target.result)
                },
            }
        }
    </script>

</div>
