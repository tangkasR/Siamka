function toast(session, message) {
    $(document).ready(function () {
        if (session == "message") {
            $.toast({
                text: `
                        <div class="py-2 font-bold text-[14px]">
                            ${message}
                        </div>
                        `,
                showHideTransition: "slide",
                // textColor: 'black',
                icon: "success",
                position: "top-right",
                allowToastClose: false,
                bgColor: "#00d447",
                loaderBg: "#6f00ff",
                hideAfter: 3000,
            });
        }
        if (session == "error") {
            $.toast({
                text: `
                        <div class="py-2 font-bold text-[14px]">
                            ${message}
                        </div>
                        `,
                showHideTransition: "slide",
                icon: "error",
                position: "top-right",
                hideAfter: false,
                bgColor: "#fc3b2d",
            });
        }
    });
}
