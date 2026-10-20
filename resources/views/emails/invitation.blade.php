<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>You have been invited</title>

</head>

<body style="
    margin: 0;
    padding: 0;
    background-color: #f5f7fb;
    font-family: Arial, Helvetica, sans-serif;
    color: #111827;
">

    <table
        width="100%"
        cellpadding="0"
        cellspacing="0"
        border="0"
        style="
            width: 100%;
            background-color: #f5f7fb;
            padding: 40px 16px;
        "
    >

        <tr>

            <td align="center">

                <table
                    width="100%"
                    cellpadding="0"
                    cellspacing="0"
                    border="0"
                    style="
                        width: 100%;
                        max-width: 560px;
                        background-color: #ffffff;
                        border: 1px solid #e5e7eb;
                        border-radius: 16px;
                        overflow: hidden;
                    "
                >

                    {{-- Header --}}

                    <tr>

                        <td
                            align="center"
                            style="
                                padding: 32px 30px;
                                background-color: #2563eb;
                            "
                        >

                            <h1 style="
                                margin: 0;
                                color: #ffffff;
                                font-size: 28px;
                                line-height: 1.3;
                                font-weight: 700;
                            ">
                                You have been invited
                            </h1>

                        </td>

                    </tr>


                    {{-- Content --}}

                    <tr>

                        <td
                            style="
                                padding: 36px 32px;
                            "
                        >

                            <p style="
                                margin: 0 0 18px;
                                font-size: 16px;
                                line-height: 1.6;
                                color: #111827;
                            ">

                                Hello {{ $invitation->name }},

                            </p>


                            <p style="
                                margin: 0 0 18px;
                                font-size: 15px;
                                line-height: 1.7;
                                color: #64748b;
                            ">

                                You have been invited to create an account.

                            </p>


                            <p style="
                                margin: 0 0 24px;
                                font-size: 15px;
                                line-height: 1.7;
                                color: #64748b;
                            ">

                                Click the link below to accept your invitation:

                            </p>


                            {{-- Button --}}

                            <table
                                cellpadding="0"
                                cellspacing="0"
                                border="0"
                                style="margin-bottom: 30px;"
                            >

                                <tr>

                                    <td>

                                        <a
                                            href="{{ route('invitations.show', $invitation->token) }}"
                                            style="
                                                display: inline-block;
                                                padding: 13px 22px;
                                                background-color: #2563eb;
                                                color: #ffffff;
                                                font-size: 15px;
                                                font-weight: 600;
                                                line-height: 1;
                                                text-decoration: none;
                                                border-radius: 9px;
                                            "
                                        >
                                            Accept Invitation
                                        </a>

                                    </td>

                                </tr>

                            </table>


                            {{-- Expiration --}}

                            <table
                                width="100%"
                                cellpadding="0"
                                cellspacing="0"
                                border="0"
                                style="
                                    background-color: #f8fafc;
                                    border: 1px solid #e5e7eb;
                                    border-radius: 10px;
                                "
                            >

                                <tr>

                                    <td
                                        style="
                                            padding: 16px 18px;
                                        "
                                    >

                                        <p style="
                                            margin: 0;
                                            font-size: 13px;
                                            line-height: 1.6;
                                            color: #64748b;
                                        ">

                                            This invitation expires on:

                                        </p>

                                        <p style="
                                            margin: 5px 0 0;
                                            font-size: 14px;
                                            line-height: 1.6;
                                            font-weight: 600;
                                            color: #111827;
                                        ">

                                            {{ $invitation->expires_at }}

                                        </p>

                                    </td>

                                </tr>

                            </table>

                        </td>

                    </tr>


                    {{-- Footer --}}

                    <tr>

                        <td
                            align="center"
                            style="
                                padding: 20px 30px;
                                border-top: 1px solid #e5e7eb;
                                background-color: #fafafa;
                            "
                        >

                            <p style="
                                margin: 0;
                                font-size: 12px;
                                line-height: 1.5;
                                color: #94a3b8;
                            ">

                                This is an automated invitation email.

                            </p>

                        </td>

                    </tr>

                </table>

            </td>

        </tr>

    </table>

</body>

</html>