package com.example.kotlin_assignment_eighteen.network

import com.example.kotlin_assignment_eighteen.api.Tasks
import com.example.kotlin_assignment_eighteen.api.Users
import okhttp3.OkHttpClient
import okhttp3.logging.HttpLoggingInterceptor
import retrofit2.Retrofit
import retrofit2.converter.gson.GsonConverterFactory

class NetworkConfig {
    private fun getInterceptor(): OkHttpClient {
        val logging = HttpLoggingInterceptor()
        logging.level = HttpLoggingInterceptor.Level.BODY
        return OkHttpClient.Builder()
            .addInterceptor(logging)
            .build()
    }

    private fun getRetrofit() : Retrofit {
        return Retrofit.Builder()
            .baseUrl("http://192.168.1.6/kotlin-assignment-nineteen/todolist_rest_api.php/")
            .client(getInterceptor())
            .addConverterFactory(GsonConverterFactory.create())
            .build()
    }

    private fun getRetrofitUser() : Retrofit {
        return Retrofit.Builder()
            .baseUrl("http://192.168.1.6/kotlin-assignment-nineteen/users_rest_api.php/")
            .client(getInterceptor())
            .addConverterFactory(GsonConverterFactory.create())
            .build()
    }

    fun getService() = getRetrofit().create(Tasks::class.java)

    fun getServiceUser() = getRetrofitUser().create(Users::class.java)
}