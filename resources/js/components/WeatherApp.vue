<template>
    <div class="text-white mb-8">
        <!-- <div class="places-input text-gray-800">
            <input type="text" class="w-full">
        </div> -->
        <div class="weather-container font-sans w-128 max-w-lg overflow-hidden bg-gray-900 shadow-lg mt-4 rounded-lg ">
            <div class="current-weather flex items-center justify-between px-6 py-8">
                <div class="flex items-center">
                    <div>
                        <div class="text-6xl font-semibold">{{currentTemperature.actual}}°C</div>
                        <div>Feels like {{currentTemperature.feels}}°C</div>
                    </div>
                    <div class="mx-5 ">
                        <div class="font-semibold">{{currentTemperature.summary}}</div>
                        <div class="font-semibold">London, GB</div>
                    </div>
                </div>  
                <div>
                    <canvas ref="iconCurrent" id="iconCurrent" width="100" height="100"></canvas>

                </div>
            </div>            
            <div class="future-weather text-sm bg-gray-800 px-6 py-8 overflow-hidden">
                <div 
                v-for="(day,index) in daily" 
                :key="day.dt" 
                :class="{'mt-8' : index > 0}"
                class="flex items-center"
                
                >
                    <div class="w-1/6 text-lg text-gray-200">{{ toDayofWeek(day.dt) }}</div>
                    <div class="w-4/6 px-4 flex items-center">
                        <div>
                            <canvas width="40" height="40" :id="`icon${index+1}`" :data-icon="(toKebabCase(day.weather[0].main))" :data-icon1="day.weather[0].main + '_DAY' "></canvas>
                        </div>
                        <div class="ml-3">{{day.weather[0].description}}</div>
                    </div>
                    <div class="w-1/6 text-right">
                        <div>Max: {{Math.round(day.temp.max)}}°C</div>
                        <div>Min: {{Math.round(day.temp.min)}}°C</div>
                    </div>
                </div>
                
            </div>
            
        </div> <!--  weather container -->
    </div>
</template>

<script>
    export default {
        mounted() {
            this.fetchData()
        },
        data(){
            return {    
                city:'',
                country:'',
                currentTemperature:{
                    actual:'',
                    feels: '',
                    summary:'',
                    icon:'',
                    location
                },
                daiy:[],
            }
        },
        methods:{
            fetchData(){
                var skycons = new Skycons({'color': 'white'});
                
                fetch(`/api/weather`)
                    .then(response => response.json())
                    .then(data =>{
                        this.currentTemperature.actual = Math.round(data.current.temp)
                        this.currentTemperature.feels = Math.round(data.current.feels_like)
                        this.currentTemperature.summary = data.current.weather[0].main 
                        // this.currentTemperature.icon = data.weather[0].icon
                        // this.timezone = data.timzone
                        // this.country = data.sys.country
                        
                        this.daily = data.daily
                        skycons.add('iconCurrent', this.currentTemperature.summary + '_DAY');
                        skycons.play();
                        


                        this.$nextTick(() =>{
                            skycons.add('icon1', document.getElementById('icon1').getAttribute('data-icon'))
                            skycons.add('icon1', document.getElementById('icon1').getAttribute('data-icon1'))
                            skycons.add('icon2', document.getElementById('icon2').getAttribute('data-icon'))
                            skycons.add('icon2', document.getElementById('icon2').getAttribute('data-icon1'))
                            skycons.add('icon3', document.getElementById('icon3').getAttribute('data-icon'))
                            skycons.add('icon4', document.getElementById('icon4').getAttribute('data-icon'))
                            skycons.add('icon5', document.getElementById('icon5').getAttribute('data-icon'))
                            skycons.add('icon6', document.getElementById('icon6').getAttribute('data-icon'))
                        })
                        
                       console.log(data)
                       console.log(this.daily)
                    })
            },
            toKebabCase(strinToConvert){
                return strinToConvert.split(' ').join('-')
            },
            toDayofWeek(timestamp){
                const newDate =  new Date(timestamp*1000)
                const days = ['SUN', 'MON', 'TUE', 'WED', 'THU', 'FRI', 'SAT'];
                return days[newDate.getDay()]
            }
        }
    }
</script>
