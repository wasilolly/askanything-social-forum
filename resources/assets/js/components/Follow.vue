<template>
    <div>
        
		<p class="text-center" v-if="loading">
			Loading....
		</p>
		
		<p class="text-center" v-if="!loading">
			<button class="btn btn-secondary" v-if="status == 0" @click="follow">Follow</button>
			
			<div class="dropdown text-center" v-if="status == 'follower'">
				<button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" 
					data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >Follower			
				</button>
				<div class="dropdown-menu">
					<a class="dropdown-item" href="#" @click="follow">Follow Back</a>
				</div>
			</div>
			
			<div class="dropdown text-center" v-if="status == 'following'">
				<button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" 
					data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Following
				</button>
				<div class="dropdown-menu">
					<a class="dropdown-item" href="#" @click="unFollow">Unfollow</a>
				</div>
			</div>
			
		</p>
        
    </div>
</template>

<script>
    export default {
        created() {
             axios.get('/check/'+this.profile_user_id)
			.then((resp) =>{
				console.log(resp)
				this.status = resp.data.status
				this.loading= false
			});
        },		
		props:['profile_user_id'],
		data(){
			return{
				status:'',
				loading: true
			}
		},
		methods:{
			follow(){
				this.loading = true;
				axios.get('/follow/' + this.profile_user_id)
				.then((resp)=>{
					if(resp.data ==1 ){
						console.log(resp)
						this.status ='following';
						this.loading= false;
					}
				})
				.catch(error => {
					console.log(error);                 
				});	
			},
			
			unFollow(){
				this.loading = true;
				axios.get('/unfollow/' + this.profile_user_id)
				.then((resp)=>{
					if(resp.data ==1 ){
						console.log(resp)
						this.status =0;
						this.loading= false;
					}
				})
				.catch(error => {
					console.log(error);                 
				});	
			}
		}
    }
</script>
