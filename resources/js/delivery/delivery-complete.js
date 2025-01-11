"use strict";

let videoWatched = false; // 動画視聴フラグを追加

// 動画プレーヤーのセットアップ関数を追加
export function setupVideoPlayer() {
    const video = document.querySelector('video');
    const completeButton = document.getElementById('complete_button');
    
    if (video && completeButton) {
        completeButton.disabled = true; // 初期状態で無効化
        completeButton.classList.add('opacity-50');
        
        video.addEventListener('ended', function() {
            videoWatched = true;
            completeButton.disabled = false;
            completeButton.classList.remove('opacity-50');
        });
    }
}

export function setupDeliveryCompleteButton() {
    const completebutton = document.getElementById('complete_button');
    
    if (completebutton) {
        completebutton.addEventListener('click', function() {
            // 動画を見ていない場合は処理を中断
            if (!videoWatched) {
                alert('動画を最後まで視聴してください。');
                return;
            }


            const deliveryId = this.getAttribute('data-delivery-id'); 
            markDeliveryAsComplete(deliveryId);
        });
    }
}

function markDeliveryAsComplete(deliveryId) {
    const token = document.querySelector('meta[name="csrf-token"]').content;
    const statusDiv = document.getElementById('completion-status');

    fetch(`/influencer_education/public/user/curriculum/${deliveryId}/complete`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': token,
            'X-Requested-With': 'XMLHttpRequest'
        },

         credentials: 'same-origin'
    })

    .then(function(response) {
        return response.json();
    })
    .then(function(data) {
        if (data.success) {
            alert('受講を記録しました！');
            statusDiv.innerHTML = '<span class="text-success">受講済み</span>';
        } else {
            alert('エラーが発生しました。もう一度お試しください。');
        }
    })
    .catch(function(error) {
        console.error('Error:', error);
        alert('エラーが発生しました。もう一度お試しください。');
    });
}
